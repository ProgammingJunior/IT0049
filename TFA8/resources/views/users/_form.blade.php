<form class="form-card" method="POST" action="{{ $user->exists ? route('users.update',$user) : route('users.store') }}" enctype="multipart/form-data">
@csrf @if($user->exists) @method('PUT') @endif
<div class="field"><label for="username">Username</label><input id="username" name="username" value="{{ old('username',$user->username) }}" required>@error('username')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name',$user->full_name) }}" required>@error('full_name')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email',$user->email) }}" required>@error('email')<small class="field-error">{{ $message }}</small>@enderror</div>
@if(!$user->exists)
<div class="field"><label for="password">Password</label><input id="password" type="password" name="password" required autocomplete="new-password">@error('password')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="password_confirmation">Confirm password</label><input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"></div>
@else
<div class="field"><label for="password">New password <span class="optional">Leave blank to keep the current password</span></label><input id="password" type="password" name="password" autocomplete="new-password"></div>
<div class="field"><label for="password_confirmation">Confirm new password</label><input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password"></div>
<div class="field"><label for="avatar">Profile photo <span class="optional">Image up to 2 MB</span></label><input id="avatar" type="file" name="avatar" accept="image/*">@error('avatar')<small class="field-error">{{ $message }}</small>@enderror</div>
@endif
<div class="form-actions"><a class="button quiet" href="{{ route('users.index') }}">Cancel</a><button class="button primary">{{ $user->exists ? 'Save changes' : 'Create user' }}</button></div>
</form>
