<?php
if($_SERVER['REQUEST_METHOD']== 'POST')
        {
            $amount = $_POST['amount'];
            $category_id = $_POST['category_id'];
            $qty = $_POST['qty'];
            echo $amount;
            echo $category_id;
            echo $qty;
            exit();

            session_start();
            $user_id = base64_decode($_SESSION['id']);

            $date = date("Y/m/d");

            $this->model('ExpenseModel');
            $expense = new ExpenseModel();
            $expense->setAmount($amount);
            $expense->setCategory($category_id);
            $expense->setUser($user_id);
            $expense->setQty($qty);
            $expense->setDate($date);
            $expenseCreated = $this->db->create('expenses',$expense->toArray());
        }

        redirect('expense');
?>