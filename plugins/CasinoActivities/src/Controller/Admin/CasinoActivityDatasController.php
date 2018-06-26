<?php
namespace CasinoActivities\Controller;

use CasinoActivities\Controller\AppController;

/**
 * CasinoActivityDatas Controller
 *
 * @property \CasinoActivities\Model\Table\CasinoActivityDatasTable $CasinoActivityDatas
 */
class CasinoActivityDatasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Casinos', 'CasinoActivities']
        ];
        $casinoActivityDatas = $this->paginate($this->CasinoActivityDatas);

        $this->set(compact('casinoActivityDatas'));
        $this->set('_serialize', ['casinoActivityDatas']);
    }

    /**
     * View method
     *
     * @param string|null $id Casino Activity Data id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $casinoActivityData = $this->CasinoActivityDatas->get($id, [
            'contain' => ['Casinos', 'CasinoActivities']
        ]);

        $this->set('casinoActivityData', $casinoActivityData);
        $this->set('_serialize', ['casinoActivityData']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $casinoActivityData = $this->CasinoActivityDatas->newEntity();
        if ($this->request->is('post')) {
            $casinoActivityData = $this->CasinoActivityDatas->patchEntity($casinoActivityData, $this->request->data);
            if ($this->CasinoActivityDatas->save($casinoActivityData)) {
                $this->Flash->success(__('The casino activity data has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The casino activity data could not be saved. Please, try again.'));
            }
        }
        $casinos = $this->CasinoActivityDatas->Casinos->find('list', ['limit' => 200]);
        $casinoActivities = $this->CasinoActivityDatas->CasinoActivities->find('list', ['limit' => 200]);
        $this->set(compact('casinoActivityData', 'casinos', 'casinoActivities'));
        $this->set('_serialize', ['casinoActivityData']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Casino Activity Data id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $casinoActivityData = $this->CasinoActivityDatas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $casinoActivityData = $this->CasinoActivityDatas->patchEntity($casinoActivityData, $this->request->data);
            if ($this->CasinoActivityDatas->save($casinoActivityData)) {
                $this->Flash->success(__('The casino activity data has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The casino activity data could not be saved. Please, try again.'));
            }
        }
        $casinos = $this->CasinoActivityDatas->Casinos->find('list', ['limit' => 200]);
        $casinoActivities = $this->CasinoActivityDatas->CasinoActivities->find('list', ['limit' => 200]);
        $this->set(compact('casinoActivityData', 'casinos', 'casinoActivities'));
        $this->set('_serialize', ['casinoActivityData']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Casino Activity Data id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $casinoActivityData = $this->CasinoActivityDatas->get($id);
        if ($this->CasinoActivityDatas->delete($casinoActivityData)) {
            $this->Flash->success(__('The casino activity data has been deleted.'));
        } else {
            $this->Flash->error(__('The casino activity data could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
