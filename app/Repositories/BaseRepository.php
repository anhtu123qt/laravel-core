<?php
    namespace App\Repositories;
    
    use Illuminate\Support\Facades\Log;
    use App\Repositories\RepositoryInterface;
    use Illuminate\Support\Facades\DB;

    abstract class BaseRepository implements RepositoryInterface 
    {
        /**
        * @var \Illuminate\Database\Eloquent\Model
        */
        protected $model;

        public function __construct()
        {
            $this->setModel();
        }

        abstract public function getModel();

        /**
         * Set model
         */
        public function setModel()
        {
            return $this->model = app()->make(
                $this->getModel()
            );
        }

        public function getAll()
        {
            return $this->model->all();
        }

        public function getOne($id) 
        {
            try {
                $data =  $this->model->find($id);

                return $data;
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
        
        public function create(array $attrs)
        {
            try {
                $data = $this->model->create($attrs);

                return $data;
            } catch (\Exception $e) {
                Log::error($e);
            }   
               
        }

        public function update($id,array $attrs)
        {
            DB::beginTransaction();        
            try {
                $data = $this->getOne($id);
                if($data) {
                    $data->update($attrs);
                    DB::commit();

                    return $data;
                }
            } catch (\Exception $e) {
                DB::rollback();

                Log::error($e);

            }
        }

        public function delete($id) 
        {
            DB::beginTransaction();
            try {
                $data = $this->getOne($id);
                if($data) {
                    $data->delete();
                    DB::commit();

                    return true;
                }
            } catch (\Exception $e) {
                DB::rollback();

                Log::error($e);
            }
        }

    }
?>