$( document ).ready(function() {
    $(".cheque ").hide()
    $(".creditcard").hide()
});

// $(document).ready(function() {

                    //     $(".paytype").hide();
                    //     $(".payment").hide();
                        $(".paymethod").change(function() {
                            var paymethod = $(".paymethod").val();
                              console.log(paymethod);
                            if($(".paymethod").val()=="credit") {
                                console.log("credit");
                                $(".cheque ").hide()
                                $(".creditcard").show()
                               
                               
                            }else if($(".paymethod").val()=="cheque"){
                                $(".creditcard").hide()

                                $(".cheque ").show()
                            }else if($(".paymethod").val()=="cash"){
                                $(".cheque ").hide()
                                $(".creditcard").hide()

                            }
                        });

   
                    // });