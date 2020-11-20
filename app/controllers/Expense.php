<?php

class Expense extends Controller{

    private $db;
    
    function __construct()
    {
        $this->db = new Database;
    }

    function index(){
        $data = [
            'title' =>'Expense List',
        ];
        $this->view('expense/index',$data);
    }

    public function expenseData(){
        $expenses = $this->db->expenseView();
        $json = array('data' => $expenses);
        echo json_encode($json);
    }
    
    function create(){
        $categories = $this->db->readAll('categories');
        $data = [   
            'title' => "New Expense",
            'types' => $categories
        ];
        $this->view('expense/create',$data);
    }
    public function store()
    {
        if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $amount = $_POST['amount'];
            $category_id = $_POST['category_id'];
            $qty = $_POST['qty'];

            session_start();
            $user_id = base64_decode($_SESSION['id']);
            // echo $user_id;
            // exit();

            $date = date("Y/m/d");

            $this->model('ExpenseModel');
            $expense = new ExpenseModel();
            $expense->setAmount($amount);
            $expense->setCategory($category_id);
            $expense->setUser($user_id);
            $expense->setQty($qty);
            $expense->setDate($date);
            $expenseCreated = $this->db->create('expenses',$expense->toArray());
            // print_r($expenseCreated);
            // exit();
        }

        redirect('expense');
    }
    
    function destory($id){
        $this->db->delete('expenses',$id);
        setMessage("Expense Data has been Deleted!");
        redirect('/expense/index');
    }
    function edit($id){
        $category = $this->db->readAll('categories');
        $expense = $this->db->getById('expenses',$id);
        $data = [
            'title' => "Edit Expense",
            'category' => $category,
            'expense' => $expense
        ];
        $this->view('expense/edit',$data);
    }

    function update($id){
        if($_SERVER['REQUEST_METHOD']=="POST"){
        $category_id = $_POST['type'];
        $qty = $_POST['qty'];
        $amount = $_POST['amount'];
        $date = $_POST['date'];
        $user_id = 1;
        $category = $_POST['type'];

        $expense = $this->model('ExpenseModel');
        $expense->setId($id);
        $expense->setAmount($amount);
        $expense->setDate($date);
        $expense->setCategory($category);
        $expense->setUser($user_id);
        $expense->setQty($qty);

        $updated = $this->db->update('expenses',$id,$expense->toArray());
        setMessage("Expense Data Updated !");
        redirect('/expense/index');
    }
    else{
        redirect('/expense/index');
    }
}
}