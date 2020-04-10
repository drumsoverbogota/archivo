<script src="https://www.google.com/recaptcha/api.js?render=6LfuWugUAAAAAI40yQW0DDegrVSTkmXBqizA6wpj"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LfuWugUAAAAAI40yQW0DDegrVSTkmXBqizA6wpj', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
<div class="center-justified">

<p><b>Contacto</b></p>

<p>
¿Encontró algún dato que está mal? ¿Tiene algún disco que aún no está acá? ¿Nos quiere mentar la madre por casposos (<a href="https://www.youtube.com/watch?v=0la5DBtOVNI" target="_blank">si puede por favor evítelo</a>)?<br>
Por favor, contáctenos acá:
</p>

<div class="row">
    <div class="col-lg-12">
        <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('msg'); ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>
 <form action="<?php echo site_url('paginas/send');?>" method="POST" class="add-emp" id="add-emp">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-user-o"></i>
                    </span>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
        </div> 
        <div class="col-lg-12">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-comments"></i>
                    </span>
                    <textarea name="comment" cols="3" rows="5" class="form-control" id="comment" placeholder="Comentario"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-right">
            <button type="reset" name="reset_add_emp" id="re-submit-emp" class="btn btn-danger"><i class="fa fa-undo"></i> Reset</button>
            <button type="submit" name="add_emp" id="submit-emp" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send</button>
        </div>
    </div>  
    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
</form>

</div>