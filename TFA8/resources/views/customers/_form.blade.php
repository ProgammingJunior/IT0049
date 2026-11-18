<form class="form-card" method="POST" action="{{ $customer->exists ? route('customers.update',$customer) : route('customers.store') }}">
@csrf @if($customer->exists) @method('PUT') @endif
<div class="field"><label for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name',$customer->full_name) }}" required maxlength="100">@error('full_name')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email',$customer->email) }}" required>@error('email')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="phone">Phone</label><input id="phone" name="phone" value="{{ old('phone',$customer->phone) }}">@error('phone')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="form-actions"><a class="button quiet" href="{{ route('customers.index') }}">Cancel</a><button class="button primary">{{ $customer->exists ? 'Save changes' : 'Create customer' }}</button></div>
</form>
