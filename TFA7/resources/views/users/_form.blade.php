<form class="form-card" method="POST" action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" enctype="multipart/form-data">
@csrf @if ($user->exists) @method('PUT') @endif
<div class="field"><label for="username">Username</label><input id="username" name="username" value="{{ old('username', $user->username) }}" required maxlength="50" autocomplete="username">@error('username')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required maxlength="100" autocomplete="name">@error('full_name')<small class="field-error">{{ $message }}</small>@enderror</div>
@if ($user->exists)<div class="field"><label for="avatar">Profile photo <span class="optional">Optional · image up to 2 MB</span></label><input id="avatar" type="file" name="avatar" accept="image/*">@error('avatar')<small class="field-error">{{ $message }}</small>@enderror</div>
@if ($user->avatar)<div class="current-avatar"><img class="avatar avatar-large" src="{{ Storage::url($user->avatar) }}" alt="Current profile photo"><span>Current prepared photo</span></div>@endif
@endif
<div class="form-actions"><a class="button quiet" href="{{ route('users.index') }}">Cancel</a><button class="button primary">{{ $user->exists ? 'Save changes' : 'Create user' }}</button></div>
</form>
