@props(['error' => 'email'])

@error($error)
    <div $attributes->merge(["class" => "px-5 d-block"])>
        <div class="alert alert-danger rounded  alert-dismissible fade show py-0 mt-1" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close  p-1" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@enderror
