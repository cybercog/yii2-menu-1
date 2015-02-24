<?php

namespace fonclub\menu\widgets;

use fonclub\menu\models\MenuType;
use \fonclub\menu\models\MenuItem;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * Class NavbarWidget
 * @package fonclub\menu\widgets
 */
class NavbarWidget extends Nav
{
    public $items = [];

    public $encodeLabels = true;

    public $activateItems = true;

    public $activateParents = false;

    public $route;

    public $params;

    public $menuType;


    /**
     * Renders the widget.
     */
    public function init()
    {
        parent::init();
        $this->items = $this->getMenuItems($this->menuType);
    }


    /**
     * @param array $item
     * @return bool
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        } elseif (isset($item['url']) && !is_array($item['url'])) {
            $route = $item['url'];
            $url = Yii::$app->request->url;

            if (ltrim($item['url'], '/') == $url or $item['url'] == $url) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * @param $menuType
     * @return array
     */
    public function getMenuItems($menuType)
    {
        $menuItems = $this->getTree(null, $menuType);

        return $menuItems;
    }

    /**
     * @param $url
     * @return array
     */
    public static function checkParams($url)
    {
        $params = array();

        if ($url == 'javascript:void();')
            return $url;

        $pos = strpos($url, "?");
        if ($pos !== false) {
            $route = array(substr($url, 0, $pos));
            $param = substr($url, $pos + 1);
            parse_str($param, $params);
            $urlParam = array_merge($route, $params);
        } else
            $urlParam[] = $url;


        return $urlParam;
    }

    /**
     * @param null $parent_id
     * @param string $menuTypeName
     * @return array
     */
    public function getTree($parent_id = null, $menuTypeName = 'main')
    {
        $items = [];
        $titleFiled = 'title_' . Yii::$app->language;

        $model = MenuItem::find()->where(['status' => '1', 'parent_id' => $parent_id]);
        // Filter by parent
        if (isset($menuType)) {
            $menuType = MenuType::findOne(['like', 'name', '%' . $menuTypeName . '%']);
            $model = $model->andWhere(['menu_type_id' => $menuType->id]);
        }

        $menuItems = $model->orderBy(['sort' => 'DESC'])->all();

        foreach ($menuItems as $menuItem) {

            $url = $this->checkParams($menuItem->url);

            if ($menuItem->visible == 'all')
                $visible = true;
            elseif ($menuItem->visible == 'notuser')
                $visible = Yii::$app->user->isGuest;
            else
                $visible = Yii::$app->user->can($menuItem->visible);

            $item = [
                'label' => $menuItem->$titleFiled,
                'url' => is_array($url) ? Yii::$app->urlManager->createUrl($url) : $url,
                'visible' => $visible,
                'linkOptions' => $menuItem->data_method == 'post' ? ['data-method' => 'post'] : []
            ];

            // Get the item's children
            $children = $this->getTree($menuItem->id, $menuTypeName);

            if ($children)
                $item['items'] = $children;

            $items[] = $item;
        }

        return $items;
    }
}