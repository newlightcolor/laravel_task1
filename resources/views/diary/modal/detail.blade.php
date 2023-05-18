<div class="modal" id="modal-diary-detail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-closer" style="padding: 10px; text-align: right;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <img src="{{ $diary->local_image_path }}" width="100%">
                </div>
                <div style="padding: 15px; word-break: break-all;">
                    {{ $diary->content }}
                </div>
                <div style="padding: 5px;">
                    Date: {{ $diary->created_at }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#modal-diary-detail').modal('show');
        })
    </script>
</div>