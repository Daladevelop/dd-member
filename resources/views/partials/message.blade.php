@if(session()->has('message_content'))
    <div class="col-md-6">
        <div class="block block-themed">
            <div class="block-header bg-{{session()->get('message_type')}}">
                <h3 class="block-title">
                    {{session()->get('message_title')}}
                </h3>
            </div>
            <div class="block-content">
                <p>{{session()->get('message_content')}}</p>
            </div>
        </div>
    </div>
@endif