<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
/**
 * CasinoLikes Controller
 *
 * @property \App\Model\Table\CasinoLikesTable $CasinoLikes
 */
class CasinoLikesController extends AppController
{

   
    public function add($casinoId=null)
    {
        $casinoLike = $this->CasinoLikes->newEntity();
        if ($casinoId) {
			$casinoLike->casino_id	=	$casinoId;
			$casinoLike->user_id	=	$this->Auth->user('id');
            if ($this->CasinoLikes->save($casinoLike)) {
				$id	=	$casinoLike->id;
				$this->loadModel('Casinos');
				$result				=	$this->Casinos->find('all')->contain([
					'MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']] ])->where(['Casinos.id' => $casinoId])->select(['Casinos.id','MainPromotion.slug','title','image','url','slug'])->first();
					
				$data['success']	=	true;		
				$view 				= 	new View();
				$view->viewPath		=	'Globalusers/json';
				$view->layout		=	false;
				$Defaultlanguage	=	$this->request->session()->read('Config.language');
				
				$view->set (compact('Defaultlanguage','id','result')); 
				$html				=	$view->render('casino_liked');			
				$data['data']		=	$html;
				$data['id']			=	$id;				
				echo json_encode($data);
				exit;
				
            }
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Casino Like id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $casinoVisit = $this->CasinoLikes->find('all')->where(['user_id' => $this->Auth->user('id'),'id' => $id])->first();
        if ($this->CasinoLikes->delete($casinoVisit)) {
			$data['title']		=	'Success';
			$data['type']		=	'success';
			$data['success']	=	true;
			$data['message']	=	__('Casino has been deleted from your list',true);
			
			$this->loadModel('Casinos');
			$casino				=	$this->Casinos->find('all')->contain([
					'MainPromotion' => ['conditions' => ['is_main_promotion' => 1], 'fields' => ['slug']] ])->where(['Casinos.id' => $casinoVisit->casino_id])->select(['Casinos.id','MainPromotion.slug','title','image','url','slug'])->first();
			
			$view 				= 	new View();
			$view->viewPath		=	'Globalusers/json';
			$view->layout		=	false;
			$type				=	'like';
			$view->set (compact('id','casino','type')); 
			$html				=	$view->render('casino_like_deleted');			
			$data['data']		=	$html;
        } else {
			$data['title']		=	'Error';
			$data['type']		=	'error';
			$data['success']	=	false;
			$data['message']	=	__('Something going wrong',true);
        }
		echo json_encode($data);
		exit;
    }
}
