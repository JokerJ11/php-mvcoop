<?php

class IncomeApi extends Controller
{
    private $db;
    function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {  
        $incomes = $this->db->incomeView();
        // var_dump($incomes);
        $json = array('data' => $incomes);
        echo json_encode($json);
    }

    public function create()
    {
        $categories = $this->db->readAll('categories');
        $json = array('data' => $categories); 
        echo json_encode($json);
    }

    public function store()
    {   
        
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {        
            $amount = $_POST['amount'];
            $category_id = $_POST['category_id'];

            $user_id = $_POST['user_id'];
            
            $date = date("Y/m/d");

            $this->model('IncomeModel');
            $income = new IncomeModel();
            $income->setAmount($amount);
            $income->setCategory($category_id);
            $income->setUser($user_id);
            $income->setDate($date);
            $incomeCreated = $this->db->create('incomes',$income->toArray());
           
        } 
        $id = (int) $incomeCreated;
        $created = $this->db->getById('incomes', $id);
        if($created) {
            $data['data'] = $created;
            $data['success'] = true;
            $data['msg'] = "income created Successfully";
        } else {
            $data['success'] = false;
        }

       echo json_encode($data); 

    }

    public function edit($id)
    {
        $categories = $this->db->readAll('categories');
        $income = $this->db->getById('incomes',$id);

        $data = [
            'categories' => $categories,
            'income' => $income
        ];

        $this->view('income/edit',$data);

    }


    public function update($id)
    {
        $body = json_decode(file_get_contents('php://input'));
        // echo $body;
        // $body = ["id" => 14, "category_id" => 10]
        if($_SERVER['REQUEST_METHOD']=='PUT')
        {
             //for csrf protect        
       //     session_start();
       //     if($_POST['csrf'] != $_SESSION['input_token']) {
       //         echo "not valid request";
       //         exit;
           
       // }
       //for csrf protect
       
            // $id = $body->id;
            $amount = $body->amount;
            $category_id = $body->category_id;
            $user_id = $body->user_id;
            $date = $body->date;

            $this->model('IncomeModel');

            $income = new IncomeModel();
            $income->setId($id);
            $income->setAmount($amount);
            $income->setCategory($category_id);
            $income->setUser($user_id);
            $income->setDate($date);

            $updated = $this->db->update('incomes',$income->getId(),$income->toArray());

        }
        // var_dump($updated);
        // exit();
        $id = (int) $updated;
        $updated_data = $this->db->getById('incomes', $id);
        if($updated_data) {
            $api_data['data'] = $updated_data;
            $api_data['success'] = true;
            $api_data['msg'] = "Income Updated Successfully";
        } else {
            $api_data['success'] = false;
        }
        echo json_encode($api_data);
        redirect('income');
    }

    public function destory($id)
    {
        $this->model('IncomeModel');

        $income = new IncomeModel();
        $income->setId($id);

        $deleted = $this->db->delete('incomes',$income->getId());

        $incomes = $this->db->incomeView();
        if(count((array)$incomes) > 0 ) {
            $api_data['data'] = $incomes;
            $api_data['success'] = true;
            $api_data['msg'] = "Income Deleted Successfully";
        } else {
            $api_data['success'] = false;
        }

        echo json_encode($api_data);
        redirect('income');

    }

    
}



?>