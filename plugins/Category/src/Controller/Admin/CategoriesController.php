<?php
namespace Category\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\I18n\I18n;
use Cake\Utility\Inflector;

class CategoriesController extends AppController
{

    public $components = ['Paginator'];
	
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($type=null)
    {
		$this->clearCache();
    	if(empty($type)){
			die('Error');
		}		
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();		
		$this->paginate = [
            'order' => ['Categories.id DESC']
        ];
		I18n::locale($lanagauageList->code);
		
		$this->paginate = [
            'order' => ['Categories.id DESC'],
			'sortWhitelist' => ['name']
        ];
		
		$heading	=	Inflector::humanize($type);

		$query = $this->Categories->find();
		$query->where(['Categories.categorie_type' => $type]);	
		$query->where(['Categories.id !=' => 46]);	

		if(!empty($this->request->query)){
			$requestedQuery	=	$this->request->query;
			foreach($requestedQuery as $name => $value){
				if($name == 'page' || $name == 'language' || $name == 'sort' || $name == 'direction')
				continue;
				$query->where(['Categories_title_translation.content  LIKE' => '%'.$value.'%']);			
			}
			$this->set('requestedQuery',$requestedQuery);
		}
		$this->paginate = ['sortWhitelist' => ['title','description']];

		
        $Categories = $this->paginate($query);
       
		$this->set(compact('Categories','type','heading'));
        $this->set('_serialize', ['Categories']);
		$this->set('model',$this->modelClass);
    }

    

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($type,$type1='single')
    {
		$this->clearCache();
		if(empty($type)){
			die('Error');
		}
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();

		$heading	=	Inflector::humanize($type);
        $blockPage = $this->Categories->newEntity();
        if ($this->request->is('post')) {
			
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];

			$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';			
			$validateData['back_image']	=	isset($this->request->data['back_image']) ? $this->request->data['back_image'] : '';
			$validateData['head_image']	=	isset($this->request->data['head_image']) ? $this->request->data['head_image'] : '';
			$validateData['page_title']	=	isset($this->request->data['page_title']) ? $this->request->data['page_title'] : '';		
			$validateData['meta_description']	=	isset($this->request->data['meta_description']) ? $this->request->data['meta_description'] : '';
			// pr($validateData);
			$blockPage = $this->Categories->patchEntity($blockPage, $validateData);	
			// pr($blockPage->errors());
			if(!$blockPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$blockPage->translation($lang)->set($data, ['guard' => false]);
				}
				$blockPage 		= 	$this->Categories->patchEntity($blockPage, $validateData);

				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->image						=		$return_file_name;
					}
				}sleep(1);
				
				if(!empty($thisData['back_image']['name'])){
					$file_name         						=     $thisData['back_image']['name'];
					$tmp_name          						=     $thisData['back_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->back_image						=		$return_file_name;
					}
				}sleep(1);

				if(!empty($thisData['head_image']['name'])){
					$file_name         						=     $thisData['head_image']['name'];
					$tmp_name          						=     $thisData['head_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->head_image						=		$return_file_name;
					}
				}
				
				$blockPage->type			=	$type1;
				$blockPage->categorie_type	=	$type;
				
				
				$blockPage->categorie_type	=	$type;
				if($type == 'countries'){
					$blockPage->country_id	=	$this->request->data['country_id'];
				}
				$this->Categories->save($blockPage);
				$category_id	=	$blockPage->id;				
				if(isset($this->request->data['show_on_page']) && !empty($this->request->data['show_on_page'])){				
					$gambling_options	=	$this->request->data['show_on_page'];
					if(!empty($gambling_options)){
						foreach($gambling_options as $key => $val){
							$CategoryPages 				= 	$this->Categories->CountryPages->newEntity();
							$CategoryPages->category_id	=	$category_id;
							$CategoryPages->page_id		=	$val;
							$this->Categories->CountryPages->save($CategoryPages);							
						}
					}			
				}
				
				$this->Flash->success(__('The page has been saved.'));
				return $this->redirect(['action' => 'index',$type]);
				
			}
			$this->Flash->error(__('The page could not be saved. Please, try again.'));
        }
		
		if($type == 'countries'){
			$this->loadModel('CityManager.Country');
			$country	=	 $this->Country->find('list')->notMatching('Categories', function($q) { return $q->where(["Categories.categorie_type" => 'countries']); })->order(['name' => 'ASC']);
			$this->set('country',$country);
			
			// $show_on_page	=	 	$this->Categories->find('list',['conditions' => array('OR' => array(array('categorie_type' => 'online_casino'),array('categorie_type' => 'online-casinos'))),'keyField' => 'slug','valueField' => 'title'])->toArray();
			$show_on_page	=	 	$this->Categories->find('list',['conditions' => array('categorie_type' => 'online-casinos'),'keyField' => 'slug','valueField' => 'title'])->toArray();
			
			$this->set('show_on_page',$show_on_page);
		}
		
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('blockPage','lanagauageList','type','heading','type1'));
        $this->set('_serialize', ['blockPage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id block Page id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null,$bonus = null,$name=null)
    {
        $this->clearCache();
		$this->loadModel('Languages');
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_Default' => 1]])->first();
		
		$blockPage = $this->Categories->find('translations')
			->contain(['CountryPages'])
			->where([
				'id' => $id
			])->first();
		// pr($blockPage);
		$image		=	$blockPage->image;
		$back_image	=	$blockPage->back_image;
		$head_image	=	$blockPage->head_image;
		$type		=	$blockPage->categorie_type;
		
		$heading	=	Inflector::humanize($type);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$validateData				=	$this->request->data['_translations'][$lanagauageList->code];
			if($bonus == 'countries'){
				$validateData['slug']		=	isset($this->request->data['slug']) ? $this->request->data['slug'] : '';			
			}
			$validateData['image']		=	isset($this->request->data['image']) ? $this->request->data['image'] : '';			
			$validateData['back_image']	=	isset($this->request->data['back_image']) ? $this->request->data['back_image'] : '';
			$validateData['head_image']	=	isset($this->request->data['head_image']) ? $this->request->data['head_image'] : '';		
			$validateData['page_title']	=	isset($this->request->data['page_title']) ? $this->request->data['page_title'] : '';		
			$validateData['meta_description']	=	isset($this->request->data['meta_description']) ? $this->request->data['meta_description'] : '';
			// pr($validateData);
			$blockPage = $this->Categories->patchEntity($blockPage, $validateData);
			
			// pr($blockPage->errors());
			// pr($blockPage->errors());
			if(!$blockPage->errors()){
				foreach ($this->request->data['_translations'] as $lang => $data) {
					$blockPage->translation($lang)->set($data, ['guard' => false]);
				}
				$thisData		=	$this->request->data;				
				if(!empty($thisData['image']['name'])){
					$file_name         						=     $thisData['image']['name'];
					$tmp_name          						=     $thisData['image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->image						=		$return_file_name;
						@unlink(GALLERY_ROOT_PATH.$image);
					}
				}else{
					$blockPage->image						=		$image;
				}sleep(1);
				
				if(!empty($thisData['back_image']['name'])){
					$file_name         						=     $thisData['back_image']['name'];
					$tmp_name          						=     $thisData['back_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->back_image						=		$return_file_name;
						@unlink(GALLERY_ROOT_PATH.$image);
					}
				}else{
					$blockPage->back_image						=		$back_image;
				}sleep(1);
				if(!empty($thisData['head_image']['name'])){
					$file_name         						=     $thisData['head_image']['name'];
					$tmp_name          						=     $thisData['head_image']['tmp_name'];
					$return_file_name   					=     time().$this->change_file_name($file_name);				
					if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$return_file_name)){
						$blockPage->head_image						=		$return_file_name;
					}
				}else{
					$blockPage->head_image						=		$head_image;
				}
				if($type == 'countries'){
					$blockPage->country_id	=	$this->request->data['country_id'];
				}
				if(isset($this->request->data['show_on_page1']) && !empty($this->request->data['show_on_page1'])){
					$blockPage->show_on_page	=	json_encode($this->request->data['show_on_page1']);					
				}
				//echo "<pre>"; print_r($this->request->data); die;
				$blockPage->head_image_alt = $this->request->data['head_image_alt'];
				$blockPage->faq_mn_title = $this->request->data['faq_mn_title'];
				$blockPage->faq_title = $this->request->data['faq_title'];
				$blockPage->faq_alt = $this->request->data['faq_alt'];

				$blockPage->best_casino_title = $this->request->data['best_casino_title'];
				$blockPage->best_casino_des = $this->request->data['best_casino_des'];
				$blockPage->best_casino_reviews = $this->request->data['best_casino_reviews'];
				$blockPage->best_casino_location = $this->request->data['best_casino_location'];
				$blockPage->best_casino_earnings = $this->request->data['best_casino_earnings'];
				$blockPage->best_casino_bonuses = $this->request->data['best_casino_bonuses'];
				$blockPage->best_casino_times = $this->request->data['best_casino_times'];
				
				//echo "<pre>"; print_r($this->request->data); die;
				// $blockPage->faq_ques1 = $this->request->data['faq_ques1'];	
				// $blockPage->faq_desc1 = $this->request->data['faq_desc1'];
				// $blockPage->faq_ques2 = $this->request->data['faq_ques2'];	
				// $blockPage->faq_desc2 = $this->request->data['faq_desc2'];
				// $blockPage->faq_ques3 = $this->request->data['faq_ques3'];	
				// $blockPage->faq_desc3 = $this->request->data['faq_desc3'];							
				$this->Categories->save($blockPage);
				// <!--Start  New changing (04/08/17) by kp shekhawat -->
				
				
				$category_id	=	$blockPage->id;				
				$this->Categories->FaqQuestions->deleteAll(['category_id' => $category_id]);								
				if(isset($this->request->data['faq']) && !empty($this->request->data['faq'])){	
						
					$faq_title	=	$this->request->data['faq']['faq_title'];
					
					$faq_alt	=	$this->request->data['faq']['faq_alt'];
					
					
					
					
					
					$faq_description	=	$this->request->data['faq']['faq_description'];
					
					
					//$faq = 0;
					if(!empty($faq_title)){
						foreach($faq_title as $key => $val){ 
							$FaqPages 				= 	$this->Categories->FaqQuestions->newEntity();
							$FaqPages->category_id	=	$category_id;
							$FaqPages->faq_title	=	$val;
						  $FaqPages->faq_alt	=	$faq_alt[$key]; 
							$FaqPages->faq_description	=	$faq_description[$key];
							$this->Categories->FaqQuestions->save($FaqPages);							
						}
					}			
				}
				
				//shiv  work here
				
				  $categorys_id	=	$blockPage->id;				
				$this->Categories->GuideContents->deleteAll(['category_id' => $categorys_id]);								
				if(isset($this->request->data['guide']) && !empty($this->request->data['guide'])){
								
					$guide_title	=	$this->request->data['guide']['guide_title'];
					
					$guide_alt	=	$this->request->data['guide']['guide_alt'];
						$guide_image1	=	$this->request->data['guide']['image1'];
						$guide_image1_tmp	=	$this->request->data['guide']['image1'];
						
						$guide_image2_tmp	=	$this->request->data['guide']['image2'];
						$guide_image2	=	$this->request->data['guide']['image2'];
					//print_r($guide_image2); 
					
					
					
					$guide_description_first_block	=	$this->request->data['guide']['guide_first_block'];
					$guide_description_second_block	=	$this->request->data['guide']['guide_second_block'];
					$guide_descriptions	=	$this->request->data['guide']['guide_description'];
					$guide_description_feauture	=	$this->request->data['guide']['guide_description_feature'];
					
					$guide_aleady_image1	=	$this->request->data['guide']['image1_guides'];
						$guide_aleady_image2	=	$this->request->data['guide']['image2_guides'];
						
						$slug_guides=$this->request->data['guide']['guide_title'];
					
					
					
					//$faq = 0;
					if(!empty($guide_title)){
						foreach($guide_title as $key => $val){ 
						$guidePages = $this->Categories->GuideContents->newEntity();
							
							 $guidePages->slug=str_replace(" ","-",strtolower($slug_guides[$key]));
							
						 	$guidePages->category_id	=	$categorys_id;
							$guidePages->title 	=	$val;
							$guidePages->image_alt 	=	$guide_alt[$key];
							
						 	$guidePages->h1d	=	$guide_descriptions[$key];
							$guidePages->second_description	=	$guide_description_second_block[$key];
							$guidePages->sdescription	=	$guide_description_feauture[$key];
						 	$guidePages->description	=	$guide_description_first_block[$key];
							
							
								
							if(!empty($guide_image1[$key]['name']))
							{
								 			 $file_name                              =   time().$guide_image1[$key]['name'];
											$tmp_name                               =     $guide_image1_tmp[$key]['tmp_name'];
											$return_file_name                       =     time().$this->change_file_name($file_name);        
								
								if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$file_name)){
								
								//	$guidePages->image                      =       $return_file_name;					   
								}
								$guidePages->image 	=	$file_name;
							}
							else 
							{
								 $guidePages->image 	=	$guide_aleady_image1[$key];
							
							}
							
							if(!empty($guide_image2[$key]['name'])){
							
								$file_name                              =     time().$guide_image2[$key]['name'];
								$tmp_name                               =     $guide_image2_tmp[$key]['tmp_name'];
								$return_file_name                       =     time().$this->change_file_name($file_name);               
								if($this->moveUploadedFile($tmp_name, GALLERY_ROOT_PATH.$file_name)){
									//$guidePages->image2                      =       $return_file_name;					   
								}
								$guidePages->image2 	=	$file_name;
							}
							else
							{
							
							 $guidePages->image2 	=	$guide_aleady_image2[$key]; 
							
							}
							
						
							
							 $this->Categories->GuideContents->save($guidePages);
						//	debug($guidePages->errors());							
						}
						
					}			
				}
				
				
				
				
				// <!--End  New changing (04/08/17) by kp shekhawat -->
				
				 $category_id	=	$blockPage->id;				
				$this->Categories->CountryPages->deleteAll(['category_id' => $category_id]);								
				if(isset($this->request->data['show_on_page1']) && !empty($this->request->data['show_on_page1'])){				
					$gambling_options	=	$this->request->data['show_on_page1'];
					if(!empty($gambling_options)){
						foreach($gambling_options as $key => $val){
							$CategoryPages 				= 	$this->Categories->CountryPages->newEntity();
							$CategoryPages->category_id	=	$category_id;
							$CategoryPages->page_id		=	$val;
							$this->Categories->CountryPages->save($CategoryPages);							
						}
					}			
				}
				
				
				$this->Flash->success(__(' Information updated successfully.'));
				if($bonus == 'bonus'){
					return $this->redirect(['action' => 'edit',$id,$bonus]);
				}else{
				return $this->redirect(['action' => 'index',$type]);					
				}				
			}
			$this->Flash->error(__('The page could not be saved. Please, try again.'));
        }

        // Change 04/08/17 kp shekhawat -------------------//

        $this->loadModel('Categories.FaqQuestions');
		$FaqQuestions1	=	 	$this->Categories->FaqQuestions->find('all',['conditions' => array('category_id' => $id)]);		
		$this->set('FaqQuestions1',$FaqQuestions1); 
		
		//shiv work here
		  $this->loadModel('Categories.GuideContents');
		$guideConts1	=	 	$this->Categories->GuideContents->find('all',['conditions' => array('category_id' =>$id)]);
		//print_r($guideConts1); die;	
		$this->set('GuideConntents',$guideConts1); 
		
		
		
		if($type == 'countries'){
			$this->loadModel('CityManager.Country');
			$country	=	 $this->Country->find('list')->order(['name' => 'ASC']);
			$this->set('country',$country);		
			// $show_on_page	=	 	$this->Categories->find('list',['conditions' => array('OR' => array(array('categorie_type' => 'online_casino'),array('categorie_type' => 'online-casinos'))),'keyField' => 'slug','valueField' => 'title'])->toArray();
			$show_on_page	=	 	$this->Categories->find('list',['conditions' => array('categorie_type' => 'online-casinos'),'keyField' => 'slug','valueField' => 'title'])->toArray();
			
			$this->set('show_on_page',$show_on_page);
			$def	=	'';
			if(!empty($blockPage->country_pages)){
				foreach($blockPage->country_pages as $d){
					$def[$d->page_id]	=	$d->page_id;
				}
			}
			$this->set('def',$def);			
		}
		$lanagauageList	=	$this->Languages->find('all',['conditions' => ['is_active' => 1]]);		
		$this->set(compact('blockPage','lanagauageList','type','heading','categorie_type','bonus','id'));
        $this->set('_serialize', ['blockPage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id block Page id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		
        $this->request->allowMethod(['post', 'delete']);
        $blockPage = $this->Categories->get($id);
        if ($this->Categories->delete($blockPage)) {
            $this->Flash->success(__('The block page has been deleted.'));
        } else {
            $this->Flash->error(__('The block page could not be deleted. Please, try again.'));
        }
		$this->clearCache();
        return $this->redirect(['action' => 'index']);
    }
}
