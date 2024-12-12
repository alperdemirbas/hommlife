<h1>Dönem Düzenle</h1>

<form action="{{ route('admin.campaigns.periods.update', $period->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $period->name }}" required>
    <!-- Formun geri kalanı burada -->
</form>
