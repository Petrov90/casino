<?php

namespace Promotion\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;

/**
 * Promotions Controller
 *
 * @property \App\Model\Table\PromotionsTable $Promotions
 */
class PromotionsController extends AppController {
    /* public function beforeFilter(Event $event)
      {
      parent::beforeFilter($event);
      $this->set('model',$this->modelClass);
      } */

    public $components = ['Paginator'];
    public $paginate = [
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $query = $this->Promotions->find()->contain(['Casino']);
        if (!empty($this->request->query)) {
            $requestedQuery = $this->request->query;
            foreach ($requestedQuery as $name => $value) {
                if ($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
                    continue;
                $query->where(["Casino." . $name . ' LIKE' => '%' . $value . '%']);
            }
            $this->set('requestedQuery', $requestedQuery);
        }
        // $query->where(['categorie_type' => 'bonus_type']);		
        $this->paginate = ['sortWhitelist' => ['title', 'Promotions.id'],
            'limit' => 10,
            'order' => [
                'Promotions.id' => 'desc'
        ]];

        $Promotionss = $this->paginate($query);

        $model = $this->modelClass;
        $this->set(compact('Promotionss', 'model'));
        $this->set('_serialize', ['Promotionss']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $casino = $this->Promotions->newEntity();
        if ($this->request->is('post')) {
            $casino = $this->Promotions->patchEntity($casino, $this->request->data);
            // echo "<pre>";
            // print_r($casino);die;
            if (!$casino->errors()) {
                $casinoId = $this->request->data['casino_id'];
                $mainPromotions = $this->Promotions->find('all')->where(['casino_id' => $casinoId])->order(['is_main_promotion' => 'desc'])->first();

                if (empty($mainPromotions)) {
                    $casino->is_main_promotion = 1;
                }

                $textdomain = $casino->text1;
                if (!empty($textdomain)) {
                    $casino->text = json_encode($textdomain);
                }
                $thisData = $this->request->data;
                if (!empty($thisData['logo']['name'])) {
                    $file_name = $thisData['logo']['name'];
                    $tmp_name = $thisData['logo']['tmp_name'];
                    $return_file_name = time() . $this->change_file_name($file_name);
                    if ($this->moveUploadedFile($tmp_name, PROMOTION_CASINO_LOGO_ROOT_PATH . $return_file_name)) {
                        $casino->logo = $return_file_name;
                    }
                }

                $this->Promotions->save($casino);
                $promotion_id = $casino->id;

                $gambling_options = $casino->gambling_options;
                if (!empty($gambling_options)) {
                    foreach ($gambling_options as $key => $val) {
                        if ($val && $key > 0) {
                            $CasinoGamblingOptions = $this->Promotions->PromotionBonusTypes->newEntity();
                            $CasinoGamblingOptions->promotion_id = $promotion_id;
                            $CasinoGamblingOptions->category_id = $key;
                            $this->Promotions->PromotionBonusTypes->save($CasinoGamblingOptions);
                        }
                    }
                }
                // die;
                $this->Flash->success(__('The promotion has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {

                $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('Categories');
        $bonus_type = $this->Categories->find('list')->where(['categorie_type' => 'bonus_type', 'id !=' => 46]);

        $this->set(compact('casino', 'bonus_type'));
        $this->set('_serialize', ['casino']);
    }

    function getLnt($address) {
        if (!empty($address)) {
            $key = '';
            $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&sensor=false&key=" . $key;
            $result_string = file_get_contents($url);
            $result = json_decode($result_string, true);

            $location = isset($result['results']['0']['geometry']['location']) ? $result['results']['0']['geometry']['location'] : '';
            return $location;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

        $casino = $res = $this->Promotions->get($id, [
            'contain' => [
                'Casino',
                'PromotionBonusTypes'
            ]
        ]);
//        print_r($casino);die;
        $res1 = $res->logo;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $casino = $this->Promotions->patchEntity($casino, $this->request->data);
            
            if (!$casino->errors()) {
                $textdomain = $casino->text1;
                if (!empty($textdomain)) {
                    $casino->text = json_encode($textdomain);
                }
                $thisData = $this->request->data;
                if (!empty($thisData['logo']['name'])) {
                    $file_name = $thisData['logo']['name'];
                    $tmp_name = $thisData['logo']['tmp_name'];
                    $return_file_name = time() . $this->change_file_name($file_name);
                    if ($this->moveUploadedFile($tmp_name, PROMOTION_CASINO_LOGO_ROOT_PATH . $return_file_name)) {
                        $casino->logo = $return_file_name;
                    }
                } else {
                    $casino->logo = $res1;
                }
                $casino->small_text = $this->request->data['small_text'];
                $casino->small_text2 = $this->request->data['small_text2'];
                $casino->bonus_amount = $this->request->data['bonus_amount'];
                 $casino->Currency = $this->request->data['Currency'];
               
                $this->Promotions->save($casino);
                
                //  echo "<pre>";
                // print_r($casino);die;
                $promotion_id = $casino->id;


                $this->Promotions->PromotionBonusTypes->deleteAll(['promotion_id' => $promotion_id]);

                $gambling_options = $casino->gambling_options;
                if (!empty($gambling_options)) {
                    foreach ($gambling_options as $key => $val) {

                        if ($val && $key > 0) {
                            $CasinoGamblingOptions = $this->Promotions->PromotionBonusTypes->newEntity();
                            $CasinoGamblingOptions->promotion_id = $promotion_id;
                            $CasinoGamblingOptions->category_id = $key;
                            $this->Promotions->PromotionBonusTypes->save($CasinoGamblingOptions);
                        }
                    }
                }
                //	die;
                $this->Flash->success(__('The Promotion has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {

                $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
            }
        }


        $this->loadModel('Categories');
        $bonus_type = $this->Categories->find('list')->where(['categorie_type' => 'bonus_type', 'id !=' => 46]);

        $promotion_bonus_types_array = '';
        foreach ($casino->promotion_bonus_types as $promotion_bonus_types) {
            $promotion_bonus_types_array[$promotion_bonus_types->category_id] = $promotion_bonus_types->category_id;
        }
        // pr($promotion_bonus_types_array);
        $this->set(compact('casino', 'bonus_type', 'promotion_bonus_types_array'));
        $this->set('_serialize', ['casino']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $casino = $this->Promotions->get($id);

        if ($this->Promotions->delete($casino)) {
            $this->Flash->success(__('The promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The promotion could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Casino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function feat($id = null, $status) {
        $casino = $res = $this->Promotions->get($id);

        $casino->isfeat = $status;
        $this->Promotions->save($casino);

        $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index']);
    }

    public function isMainPromotion($id = null) {
        $casino = $res = $this->Promotions->get($id);

        $this->Promotions->query()
                ->update()
                ->set(['is_main_promotion' => 0])
                ->where(['casino_id' => $casino->casino_id])
                ->execute();

        $casino->is_main_promotion = 1;
        $this->Promotions->save($casino);

        $this->Flash->success(__('Status changes successfully.'));
        return $this->redirect(['action' => 'index']);
    }

    public function cityAutocomplete() {
        $this->loadModel('Casinos');

        $query = $this->request->query['q'];

        $results = $this->Casinos->find('all')->where(['title LIKE' => '%' . $query . '%', 'type' => 'online'])->limit(7);

        echo json_encode($results);
        exit;
    }

}
