<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use Cake\Core\Configure;
use Cake\Cache\Cache;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

class NewsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('RequestHandler');
	}
	
	public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
        $this->Auth->allow(array('news','newsView','feed'));
    }

	function news($id=null){	
		if (($newsBlock = Cache::read('newsBlock','longlong')) === false) {
			$this->loadModel('Block.Blocks');
			$newsBlock = $this->Blocks->find('translations')->where(['Blocks.id' => 26])->first();
				
			Cache::write('newsBlock', $newsBlock,'longlong');
		}
		
		$pageTitle	=	__('title.news');
		$metaDescription	=	__('metadescription.news');
		
		
		$this->loadModel('News.News');			
		$mainNews 	= $this->News->find('translations')->contain(['NewsUser' => ['fields' => ['name']]])->where(['News.is_feat' => '1'])->first();
		
		if(empty($mainNews->id)){
			$mainNews 	= $this->News->find('translations')->contain(['NewsUser' => ['fields' => ['name']]])->order(['News.id' => 'desc'])->first();
		}
		
		$this->loadModel('CasinoImages');
		if(!empty($mainNews->object_id)){
			$casinoImage			=	$this->CasinoImages->find('all')->where(['object_id' => $mainNews->object_id]);
		}
		
		$query = $this->News->find();
		if(!empty($this->request->data['search'])){
			$value	=	$this->request->data['search'];
			$query->orWhere(['News.title  LIKE' => '%'.$value.'%']);			
			$query->orWhere(['News.description  LIKE' => '%'.$value.'%']);			
			$query->orWhere(['News_title_translation.content  LIKE' => '%'.$value.'%']);			
			$query->orWhere(['News_description_translation.content  LIKE' => '%'.$value.'%']);			
			
			$this->set('requestedQuery',$value);
			$mainNews	=	'';
		}
		
		$this->paginate = ['sortWhitelist' => ['title','description'],'limit' => 15,'contain' => ['NewsUser' => ['fields' => ['name']]]];
		$query->order(['News.id' => 'desc']);
		
		if(!empty($id)){
			$query->where(['News.master_id' => $id]);
		}
		if(!empty($mainNews->id)){
			$query->where(['News.id !=' => $mainNews->id]);
		}
		
        $result = $this->paginate($query);		
		$this->set(compact('result','newsBlock','mainNews','casinoImage','pageTitle','metaDescription'));
	}
	
	 public function newsView($slug = null)
    {
		if($slug == null){
			$this->redirect(array('action' => 'news'));
		}
		$this->loadModel('News.News');
		$result = $this->News->find('translations')->contain(['NewsUser' => ['fields' => ['name']],'Masters' => ['fields' => ['name','slug']]])->where([
				'News.slug' => $slug
			])->first();			
		$slugName	=	'news_view';
		if(!empty($result->id)){
			$this->loadModel('CasinoImages');
			$casinoImage			=	$this->CasinoImages->find('all')->where(['object_id' => $result->object_id]);
			
			$relatedNews			=	$this->News->find('translations')->where([
				'News.master_id' => $result->master_id,'News.id !=' => $result->id
			])->limit('3')->order('rand()');	
			
			
			$pageTitle			=	$result->meta_keyword;
			$metaDescription	=	!empty($result->meta_description) ? $result->meta_description : $result->meta_keyword;
			$this->set(compact('result','slug','slugName','casinoImage','pageTitle','metaDescription','relatedNews'));
		}		
		if(empty($result->id)){			
						
			$this->loadModel('Master.Masters');
			$masters				=	$this->Masters->find('all')->where(['slug' => $slug])->first();
			$this->news($masters->id);
			
			$pageTitle			=	$masters->meta_title;
			$metaDescription	=	$masters->meta_description;
			
			$this->set(compact('slug','slugName','pageTitle','metaDescription','masters'));
			$this->render('news_category');
		}
    }
	
	
	public function feed()
	{
				$this->viewBuilder()->layout('rss');

		/* if ($this->RequestHandler->isRss() ) { */
			$articles = $this->News
				->find()
				->limit(20)
				->order(['created' => 'desc']);
			$this->set(compact('articles'));
		/* } else {
			throw new NotFoundException(__('Page not found'));
		} */
	}	
}
