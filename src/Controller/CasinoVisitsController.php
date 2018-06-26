<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\View\View;
use Cake\Network\Exception\NotFoundException;


/**
 * CasinoVisits Controller
 *
 * @property \App\Model\Table\CasinoVisitsTable $CasinoVisits
 */
class CasinoVisitsController extends AppController
{

   

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($casinoId=null)
    {
        $casinoVisit = $this->CasinoVisits->newEntity();
        if ($casinoId) {
			$casinoVisit->casino_id	=	$casinoId;
			$casinoVisit->user_id	=	$this->Auth->user('id');
            if ($this->CasinoVisits->save($casinoVisit)) {
				$id	=	$casinoVisit->id;
				$this->loadModel('Casinos');
				
				$result		=	$this->Casinos->find('all')->contain([
								'City' => ['fields' => ['name','slug']],
								'City.Country' => ['fields' => ['slug']]
								])
								->where(['Casinos.id' => $casinoId])->first();
				// pr($result);
				$data['success']	=	true;		
				$view 				= 	new View();
				$view->viewPath		=	'Globalusers/json';
				$view->layout		=	false;
				$Defaultlanguage	=	$this->request->session()->read('Config.language');
				
				$view->set (compact('Defaultlanguage','id','result')); 
				$html				=	$view->render('casino_visited');			
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
     * @param string|null $id Casino Visit id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $casinoVisit = $this->CasinoVisits->find('all')->where(['user_id' => $this->Auth->user('id'),'id' => $id])->first();
        if ($this->CasinoVisits->delete($casinoVisit)) {
			$data['title']		=	'Success';
			$data['type']		=	'success';
			$data['success']	=	true;
			$data['message']	=	__('Casino has been deleted from your list',true);
			
			$this->loadModel('Casinos');
			$casino				=	$this->Casinos->find('all')->contain([
										'City' => ['fields' => ['name','slug']],
										'City.Country' => ['fields' => ['slug']]
										])
										->where(['Casinos.id' => $casinoVisit->casino_id])->first();
			
			$view 				= 	new View();
			$view->viewPath		=	'Globalusers/json';
			$view->layout		=	false;
			$type				=	'visit';
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
