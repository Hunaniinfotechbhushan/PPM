        <div class="box-body">

          <label for="email_address">Username</label>
          <div class="form-group">
            <div class="form-line">
             {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username']) !!}
             @if ($errors->has('username'))
             <p style="color:red;">
              {!!$errors->first('username')!!}
            </p>
            @endif
          </div>
        </div>
        <label for="password">Email Address</label>
        <div class="form-group">
          <div class="form-line">
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
            @if ($errors->has('email'))
            <p style="color:red;">
              {!!$errors->first('email')!!}
            </p>
            @endif
          </div>
        </div>


         <label for="email_address">Gender</label>
          <div class="form-group">
            <div class="form-line">
                              {!! Form::select('gender_selection',['Female','Male'], null,  ['class' => 'form-control']) !!}
             @if ($errors->has('gender_selection'))
             <p style="color:red;">
              {!!$errors->first('gender_selection')!!}
            </p>
            @endif
          </div>
        </div>


         <label for="email_address">Location</label>
          <div class="form-group">
            <div class="form-line">
             {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city']) !!}
             @if ($errors->has('city'))
             <p style="color:red;">
              {!!$errors->first('city')!!}
            </p>
            @endif
          </div>
        </div>


         <label for="email_address">Approval</label>
          <div class="form-group">
            <div class="form-line">
                {!! Form::select('is_verified',['Awaiting Approval','Approve','Rejected'], null,  ['class' => 'form-control']) !!}
             @if ($errors->has('is_verified'))
             <p style="color:red;">
              {!!$errors->first('is_verified')!!}
            </p>
            @endif
          </div>
        </div>


        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary waves-effect','id'=>'pagesubmit']) !!}
      </div>