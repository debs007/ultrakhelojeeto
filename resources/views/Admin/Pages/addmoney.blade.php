<div class="modal fade" id="modalAddmoney" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Money to User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post" action="add_money">
            {{ csrf_field() }}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          
          <input type="text" name="id" id="userIdAdd" class="form-control validate" value="" readonly>
          <label data-error="wrong" data-success="right" for="userIdAdd">User id</label>
        </div>
        <div class="md-form mb-5">
          
          <!--input type="text" name="activity" id="orangeForm-email" class="form-control validate"-->
            
          
        </div>

        <div class="md-form mb-4">
          
          <input type="text" name="amount" value="" id="userIdAmount" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="userIdAmount">Amount to add</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
       <input type="submit" class="btn btn-success" value="Add Money" />
      </div>
            </form>
    </div>
  </div>
</div>



<!--Add mony withdraw -->
<div class="modal fade" id="modalAddmoneyWithdraw" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Money to User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post" action="add_money_withdraw">
            {{ csrf_field() }}
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          
          <input type="text" name="id" id="userIdAdd" class="form-control validate" value="" readonly>
          <label data-error="wrong" data-success="right" for="userIdAdd">User id</label>
        </div>
        <div class="md-form mb-5">
          
          <!--input type="text" name="activity" id="orangeForm-email" class="form-control validate"-->
            
          
        </div>

        <div class="md-form mb-4">
          
          <input type="text" name="amount" value="" id="userIdAmount" class="form-control validate" required>
          <label data-error="wrong" data-success="right" for="userIdAmount">Amount to add in Winnings</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
       <input type="submit" class="btn btn-success" value="Add Money" />
      </div>
            </form>
    </div>
  </div>
</div>
<!-- end -->