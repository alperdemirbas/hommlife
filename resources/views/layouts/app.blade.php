@admin
@include('admin.layouts.app')
@elseuser
@include('user.layouts.app')
@else
    @include('user.layouts.app')
@endadmin
