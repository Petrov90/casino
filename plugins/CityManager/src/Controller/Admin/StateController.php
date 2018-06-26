<?php
namespace CityManager\Controller\Admin;
use App\Controller\Admin\AppController;
use Cake\Event\Event;
/**
 * State Controller
 *
 * @property \CityManager\Model\Table\StateTable $State
 */
class StateController extends AppController
{

	public $components = ['Paginator'];
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
		$this->set('model',$this->modelClass);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Country'],
            'sortWhitelist' => ['name','email','created']
        ];
        $query = $this->State->find();
        if(!empty($this->request->query)){
            $requestedQuery =   $this->request->query;

            foreach($requestedQuery as $name => $value){
                if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction' || $value == '')
                    continue;
                if($name == 'country_id')
                    $query->where(['State.'.$name.'' => $value]);            
                else
                    $query->where(['State.'.$name => '%'.$value.'%']);           
            }
            $this->set('requestedQuery',$requestedQuery);
        }
       //  pr($query);die;
        $state = $this->paginate($query);
        //pr($state);die;
        $Country = $this->State->Country->find('list',['order' => 'name ASC']);
        $this->set(compact('state','Country'));
        $this->set('_serialize', ['state']);
        $this->set('model',$this->modelClass);
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->State->get($id, [
            'contain' => ['Country', 'City']
        ]);

        $this->set('state', $state);
        $this->set('_serialize', ['state']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Languages');
        $lanagauageList =   $this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();

        $state = $this->State->newEntity();
        if ($this->request->is('post')) {
          
            $validateData['country_id'] =   $this->request->data['country_id'];         
            $validateData['name']   =   $this->request->data['name'];
            $validateData['code'] = $this->request->data['code'];           

            $state = $this->State->patchEntity($state,$validateData);
           // pr($state->errors());die;
            if(!$state->errors()){
                
                $state->country_id    =   $this->request->data['country_id'];
                $state->name =   $this->request->data['name'];
                $state->code =   $this->request->data['code'];
                if ($this->State->save($state)) {
                    $this->Flash->success(__('The state has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } 
             } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $Country = $this->State->Country->find('list', ['limit' => 200]);
        $this->set(compact('state', 'Country','lanagauageList'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Languages');
        $lanagauageList =   $this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();

        $state = $this->State->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
/*           
            $validateData               =   $this->request->data['_translations'][$lanagauageList->code];*/

            $validateData['country_id'] =   $this->request->data['country_id'];         
            $validateData['name']   =  $this->request->data['name'];
            $validateData['code'] = $this->request->data['code'];

            $state = $this->State->patchEntity($state, $this->request->data);
            if(!$state->errors()){                
                $state->country_id    =   $this->request->data['country_id'];
                $state->name =   $this->request->data['name'];
                $state->code =   $this->request->data['code'];
                if ($this->State->save($state)) {
                    $this->Flash->success(__('The state has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } 
             } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $Country = $this->State->Country->find('list', ['limit' => 200]);
        $this->set(compact('state', 'Country','lanagauageList'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->State->get($id);
        if ($this->State->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
