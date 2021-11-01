                                    <!-- Modal static-->
                                    <button type="button" class="btn btn-default waves-effect" data-toggle="modal" data-target="#default-Modal">Add payment</button>
                                    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Add payment</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">



                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <label class=" col-form-label">Date</label>
                                                            <input type="date" class="form-control" placeholder="" name="custadd" id="cust_add" value="<?= $customer1->customer_add ?>" required>

                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label class=" col-form-label">Reference No</label>
                                                            <input type="text" class="form-control" placeholder="" name="custadd" id="cust_add" value="<?= $customer1->customer_add ?>" required>

                                                        </div>

                                                    </div>


                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <label class=" col-form-label">Amount</label>
                                                            <input type="text" class="form-control" placeholder="" name="custadd" id="cust_add" value="<?= $customer1->customer_add ?>" required>

                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label class=" col-form-label">Payment method</label>
                                                            <select class="form-control "  id="porder_itemproductid" > 

                                    <option >Select method</option>
                                    <option >Cash</option>
                                    <option >Card</option>
                                    <option >Select product</option>

                               


                                </select>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary waves-effect waves-light ">Add payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </li>
                                    <li>
                                        <!-- Modal large-->
                                        <!-- end of card 1 -->
                                        <!-- </div> -->




                                        <div class="card-block">
                                            <div class="form-group row">

                                                <div class="col-sm-6">
                                                    <label class=" col-form-label">Payment Methord</label>
                                                    <select class="js-example-basic-single col-sm-12 paymethod" name="sinvpaymethod" required>
                                                        <option value="">Select Payment method</option>
                                                        <option value="cash">Cash </option>
                                                        <option value="credit ">Credit </option>
                                                    </select>

                                                </div>

                                            </div>
                                        </div>
