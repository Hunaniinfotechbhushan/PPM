
<div class="form-group row">
    <!-- First Name -->
    <div class="col-sm-6 mb-3 mb-sm-0">
     <label for="lwFirstName"><?= __tr('First Name') ?></label>
     {!! Form::text('first_name', null, ['class' => 'form-control', 'id' => 'name']) !!}
     @if ($errors->has('first_name'))
     <p style="color:red;">
      {!!$errors->first('first_name')!!}
  </p>
  @endif
</div>
<!-- Last Name -->
<div class="col-sm-6">
 <label for="lwLastName"><?= __tr('Last Name') ?></label>
 {!! Form::text('last_name', null, ['class' => 'form-control', 'id' => 'name']) !!}
 @if ($errors->has('last_name'))
 <p style="color:red;">
  {!!$errors->first('last_name')!!}
</p>
@endif
</div>
<!-- /Last Name -->
</div>
<div class="form-group row">
    <!-- Email -->
    <div class="col-sm-6 mb-3 mb-sm-0">
     <label for="lwEmail"><?= __tr('Email') ?></label>
     {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'name']) !!}
     @if ($errors->has('email'))
     <p style="color:red;">
      {!!$errors->first('email')!!}
  </p>
  @endif
</div>
<!-- /Email -->

<!-- Username -->
<div class="col-sm-6">
 <label for="lwUsername"><?= __tr('Username') ?></label>
 {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username']) !!}
 @if ($errors->has('username'))
 <p style="color:red;">
  {!!$errors->first('username')!!}
</p>
@endif
</div>
<!-- /Username -->
</div>


<div class="form-group row">
    <!-- Password -->
    <div class="col-sm-6 mb-3 mb-sm-0">
     <label for="lwPassword"><?= __tr('Password') ?></label>
     {!! Form::text('login_password', null, ['class' => 'form-control', 'id' => 'name']) !!}
     @if ($errors->has('login_password'))
     <p style="color:red;">
      {!!$errors->first('login_password')!!}
  </p>
  @endif
</div>
<!-- /Password -->

<!-- Confirm Password -->
<div class="col-sm-6">
 <label for="lwConfirmPassword"><?= __tr('Confirm Password') ?></label>
 {!! Form::text('login_password', null, ['class' => 'form-control', 'id' => 'name']) !!}
 @if ($errors->has('login_password'))
 <p style="color:red;">
  {!!$errors->first('login_password')!!}
</p>
@endif
</div>
<!-- Confirm Password -->
</div>


<div class="form-group row">
    <!-- Password -->
<!--     <div class="col-sm-6 mb-3 mb-sm-0">
     <label for="lwPassword"><?= __tr('Image') ?></label>
    {!! Form::file('profile_picture', null, ['class' => 'form-control', 'id' => 'name']) !!}
         @if ($errors->has('profile_picture'))
         <p style="color:red;">
          {!!$errors->first('profile_picture')!!}
      </p>
      @endif
</div> -->
<!-- /Password -->

<!-- Confirm Password -->
<div class="col-sm-6">
 <label for="lwConfirmPassword"><?= __tr('Status') ?></label>
  {!! Form::select('status',['Freeze','Activate','Deleted'], null,  ['class' => 'form-control']) !!}
             @if ($errors->has('is_verified'))
             <p style="color:red;">
              {!!$errors->first('is_verified')!!}
            </p>
            @endif
</div>
<!-- Confirm Password -->
</div>


                    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary lw-btn-block-mobile','id'=>'pagesubmit']) !!}
