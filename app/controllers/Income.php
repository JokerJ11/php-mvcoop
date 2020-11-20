<?php

class Income extends Controller
{
    private $db;
    function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {  
        $this->view('income/index');
    }

    public function create()
    {
        $categories = $this->db->readAll('categories');
        $types = $this->db->readAll('types');
        // var_dump($types);
        $data = [
            'categories' => $categories,
            'types' => $types,
            'index'  => 'income',
        ];
        $this->view('create/create',$data);
    }

    public function store()
    {   
        
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            //for csrf protect        
           // session_start();
           //      if($_POST['csrf'] != $_SESSION['input_token']) {
           //          echo "not valid request";
           //          exit;
                
           //  }
            //for csrf protect        
            $amount = $_POST['amount'];
            $category_id = $_POST['category_id'];

            $user_id = 1;
            // echo $amount;
            // echo $category_id;
            // exit();
            $date = date("Y/m/d");

            $this->model('IncomeModel');
            $income = new IncomeModel();
            $income->setAmount($amount);
            $income->setCategory($category_id);
            $income->setUser($user_id);
            $income->setDate($date);
            // $income->setUser($id);
            $incomeCreated = $this->db->create('incomes',$income->toArray());
            // redirect('income');
           
        } 
        redirect('income');

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


    public function update()
    {
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
             //for csrf protect        
           session_start();
           if($_POST['csrf'] != $_SESSION['input_token']) {
               echo "not valid request";
               exit;
           
       }
       //for csrf protect
       
            $id = $_POST['id'];
            $amount = $_POST['amount'];
            $category_id = $_POST['category_id'];
            $user_id = $_POST['user_id'];
            $date = $_POST['date'];

            $this->model('IncomeModel');

            $income = new IncomeModel();
            $income->setId($id);
            $income->setAmount($amount);
            $income->setCategory($category_id);
            $income->setUser($user_id);
            $income->setDate($date);

            $updated = $this->db->update('incomes',$income->getId(),$income->toArray());

            if($updated)
            {
                setMessage('success',"Successfully Updated !");
            }

            redirect('income');
        }
    }

    public function destory($id)
    {
        $this->model('IncomeModel');

        $income = new IncomeModel();
        $income->setId($id);

        $deleted = $this->db->delete('incomes',$income->getId());

        if($deleted)
        {
            setMessage('success',"Successfully Deleted");
        }

        redirect('income');
    }

    
}



?>