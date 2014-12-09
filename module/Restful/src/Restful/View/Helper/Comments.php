<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 下午4:09
 */

namespace Restful\View\Helper;

use Application\Controller\IndexController;
use Zend\View\Helper\AbstractHelper;

class Comments extends  AbstractHelper
{

    public function __invoke(){
          $controller=new IndexController();
           $model=$controller->indexAction()->setTemplate('application/index/view');
           return $this->getView()->render($model);

    }

} 