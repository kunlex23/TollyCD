<?php

  require '../config.php';
                            
                            $sql = "SELECT SUM(amount) AS amount FROM gbigbe WHERE status = 'Completed'";
                            // where order_date > now() - interval 1 day;
                            if ($result = $conn->query($sql)) {
                              while ($row = $result->fetch_assoc()) {
                                  $tClients = $row['amount']; 
                                  
                                 echo'
                                     <h1>'.$tClients.'</h1>
                                 ';
                              }
                              $result->free();
                            }
                            $conn->close();
                            ?>