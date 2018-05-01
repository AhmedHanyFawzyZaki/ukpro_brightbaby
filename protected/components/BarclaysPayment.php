<?php
class BarclaysPayment {

        protected $form_data=array();
        protected $secret='';

        function __construct() {
                $this->form_data = array(
                        'PSPID'=>'',
                        'ORDERID'=>'',
                        'AMOUNT'=>'',
                        'CURRENCY'=>'',
                        'LANGUAGE'=>'en_US'
                );
        }

        protected function sha_sign() {
                // Create SHASIGN and add to end of array

                ksort($this->form_data);

                $string_to_hash='';
                foreach($this->form_data as $key=>$val) {
                        $string_to_hash.=sprintf("%s=%s%s",$key,$val,$this->secret);
                }
                $sha_sign = sha1($string_to_hash);
                $this->form_data['SHASIGN']=strtoupper($sha_sign);
        }

        public function display() {
                $this->sha_sign();

                echo '<form method="post" action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp" id=form1 name=form1>';
                foreach($this->form_data as $key=>$val) {
                        echo '<input type="hidden" name="'.$key.'" value="'.$val.'">';
                }
                echo '<input type="submit" value="Continue" id="submit2" name="submit2">';
                echo '</form>';
                echo '<script type="text/javascript">';
                echo "$('#form1').submit();";
                echo '</script>';
        }

        /* Getters, setters and all that stuff */

    public function set_secret($secret)
    {
        $this->secret = $secret;
    }

    public function set_pspid($pspid)
    {
        $this->form_data['PSPID'] = $pspid;
    }

    public function set_currency($currency)
    {
        $this->form_data['CURRENCY'] = $currency;
    }

    public function set_amount($amount)
    {
        $this->form_data['AMOUNT'] = $amount;
    }

    public function set_order_id($order_id)
    {
        $this->form_data['ORDERID'] = $order_id;
    }
}
?>