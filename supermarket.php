<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
</head>
<body>
<div class="container">
<center><h1>Supermarket Application - Loan Department </h1></center>
    <form method="post">
    Client Name : <br/>
   <input type="text" name="txtname" value="<?php echo isset($_POST['txtname'])?$_POST['txtname']:'' ?>" placeholder="Enter clint Name" class="form-control"/><br/>
  
    City : <br/>
    <select name="scity" class="form-control" value="<?php echo isset($_POST['scity'])?$_POST['scity']:'' ?>">
        <option <?php if (isset($_POST['scity'])&& $_POST['scity'] == 'Cairo') echo'selected'; ?> value="Cairo">Cairo</option>
        <option  <?php if (isset($_POST['scity'])&& $_POST['scity'] == 'Giza')echo'selected';?> value="Giza">Giza</option>
        <option <?php if (isset($_POST['scity'])&& $_POST['scity'] == 'Other')echo'selected'; ?> value="Other">Other</option>
    </select><br/>
   
    Count Of Product : <br/>
    <input type="text" name="txtcount" value="<?php echo isset($_POST['txtcount'])?$_POST['txtcount']:'' ?>"  placeholder="Enter Count Of Product" class="form-control"/><br/>
    
    <input type="submit" name="btnenter"  value="Show Data Entry For Product Details" class="btn btn-warning"/><br/>
    
    <?php
        if(isset($_POST["btnenter"]))
        {
            $name=$_POST["txtname"];
            $count=$_POST["txtcount"];
            
            echo("<br/><table class='table table-border table-striped'>");
            echo("<tr><th>NO.</th><th>Product Name</th><th>Price</th><th>Quantity</th></tr>");
           
            for($x=1;$x<=$count;$x++)
            {
              echo("<tr><td>$x</td><td><input type='text' name='txtproname$x' class='form-control' placeholder='Product Name'/></td>");
              echo("<td><input type='text' name='txtprice$x' class='form-control' placeholder='Price'/></td>");
              echo("<td><input type='number' name='txtqty$x' class='form-control' placeholder='Quantity'/></td></tr>");
            }
           
            echo("<tr><td colspan='4' style='text-align:center'><input type='submit' value='Show Result' width='65%' name='btnshow' class='btn btn-danger'/></td>");

            echo("</table>");
        }
        if(isset($_POST["btnshow"]))
        {
            $count=$_POST["txtcount"];
            $total=0;
            $perce=0;
            $value=0;
            $after=0;
            $delivery=0;
            $net=0;
            echo("<br/><table class='table table-border table-striped'>");
            echo("<tr><td colspan='5'>".$_POST["txtname"]."</td></tr>");
            echo("<tr><th>NO.</th><th>Items</th><th>quantity</th><th>Price</th></th><th>SubTotal</th></tr>");
           
            for($x=1;$x<=$count;$x++)
            {
               
               
                $subname=$_POST["txtproname".$x];  
                $price=$_POST["txtprice".$x]; 
                $quantity=$_POST["txtqty".$x];
                $subTotal=$price*$quantity;
                echo("<tr><td>$x<br></td><td>$subname<br></td><td>$quantity<br></td><td>$price<br></td><td>$subTotal<br></td></tr>");
                $total += $subTotal; 

               
               
                if($total<1000)
                $perce=0;
                else if($total<3000)
                 $perce=0.05;
                else if($total<5000)
                $perce=0.10;
                else
                $perce=0.15;

                $value=$total*$perce;

                $after=$total-$value;
                $city=$_POST["scity"];
                switch($city)
        {
            case "Giza":
                $delivery=50;
                break;
            case "Cairo":
                $delivery=30;
                break;
            default:
                $delivery=40;
        }
        $net=$after+$delivery; 

        echo("<tr><td>Total</td><td colspan='4'>$total<br></td></tr>");
        echo("<tr><td>Discount Percentage</td><td colspan='4'>$perce<br></td></tr>");
        echo("<tr><td>Discount Value</td><td colspan='4'>$value<br></td></tr>");
        echo("<tr><td>Delivery</td><td colspan='4'>$delivery<br></td></tr>");
        echo("<tr><td>Net Total</td><td colspan='4'>$net<br></td></tr>");
      
       
        echo("</table>");
    }

                
                

                
                

                   
            

        }


        ?>



        </form>
    </div>    
    
    
    </body>
    </html>