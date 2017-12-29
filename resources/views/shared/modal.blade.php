<div class="modal fade shared-modal" id="{{$id}}" aria-hidden="true">
    <div class="modal-dialog {{isset($class) ? $class : null}}">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                </button>
                <h4 class="modal-title">
                    <div class="caption">
                        <span class="caption-subject font-{{$titleColor}} bold uppercase">
                            <i class="fa fa-cogs"></i>
                            {{$title}}
                        </span>
                    </div>
                </h4>
            </div>
            <div class="modal-container">
                {{isset($container) ? $container : null}}
            </div>
        </div>
    </div>
</div>