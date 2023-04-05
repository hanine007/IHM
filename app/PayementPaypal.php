<?php

namespace app;

use app\ConvertETH;


class PayementPaypal{

    private float $total;
    private $converter;
    
    public function __construct(float $total){
        $this->converter=new ConvertETH();
        $this->total= $total;
    }   

    public function payementUI(){
        $converted=round($this->converter->ETH_TO_USD($this->total),2) ;
       
        $order = json_encode([
            'purchase_units'=> [[
                'amount'=> [
                    'value'=> $converted  
                ]
            ]]
        ]);
        
        return <<<HTML
                            <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD&disable-funding=card"></script>
                                <!-- Set up a container element for the button -->
                            <div id="paypal-button-container" style="margin-top:20px;"></div>
                            <script>
                               
                                
                                paypal.Buttons({
                                    // style buttons
                                    style: {
                                        layout: 'vertical',
                                        color:  'blue',
                                        shape:  'pill',
                                        label:  'paypal'
                                    },
                                    
                                    // Sets up the transaction when a payment button is clicked
                                    createOrder: (data, actions) => {
                                    return actions.order.create({$order});
                                    },
                                    // Finalize the transaction after payer approval
                                    onApprove: (data, actions) => {
                                    return actions.order.capture().then(function(orderData) {
                                        // Successful capture! For dev/demo purposes:
                                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2)); 
                                        const transaction = orderData.purchase_units[0].payments.captures[0];
                                        /* alert(`Transaction \${transaction.status}: \${transaction.id}\n\nSee console for all available details`); */
                                        // When ready to go live, remove the alert and show a success message within this page. For example:
                                         const element = document.getElementById('thank-you');
                                         
                                         const container= document.getElementById('service');
                                         const nftid = container.getAttribute('data-service');
                                         const amount = orderData.purchase_units[0].amount.value;
                                         const date = orderData.create_time;
                                         console.log(amount);
                                            
                                         /* element.innerHTML = '<h3>Thank you for your payment!</h3>';  */
                                        // Or go to another URL:  actions.redirect('thank_you.html');
                                        fetch("/buy", {
                                                headers: {
                                                    'X-Requested-With': 'XMLHttpRequest'
                                                    
                                                    
                                                },
                                                method: 'post',
                                                body: JSON.stringify({
                                                    orderID:orderData.id,
                                                    nftID:nftid,
                                                    amount:orderData.purchase_units[0].amount.value,
                                                    date: orderData.create_time                                                                                                                                                       
                                                })
                                                
                                                    
                                                
                                            }).then(response => {
                                                response.json().then(data => {
                                                    element.style.alignItems = 'center';
                                                    console.log(data.success) ;
                                                   element.innerHTML = '<i style="font-size:150px;color:#0097e6;margin-bottom:20px;margin-top:20px;"class="fa-regular fa-circle-check"></i><h3>Thank you for your payment!</h3><a href="/account?tab=collected"><u>view order</u></a>'
                                                    
                                                }) 
                                            }).catch(error => {
                                                console.log(error)
                                            }); 
                                    });
                                    }
                                }).render('#paypal-button-container');
                            </script>
        HTML;
    }
}