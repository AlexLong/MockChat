<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;


use Application\Service\NodeAuthService;
use UserPost\Domain\Concrete\PostRepository;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public $post_rep;




   public function indexAction()
   {



        return new ViewModel();
   }




    /**
     * @return PostRepository
     */
    public function getPostRep()
    {
        if(!$this->post_rep){
            $this->post_rep = $this->getServiceLocator()->get('postRepository');
        }
        return $this->post_rep;
    }



}
