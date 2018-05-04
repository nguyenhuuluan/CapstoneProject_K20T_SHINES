                @if (session()->has('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
                @endif