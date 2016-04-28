<div class="row">
	<div class="col-md-12 text-center">
		<h2>表单测试</h2>
		<?php echo $this->tag->form("sign/register"); ?>
		 <p>
		    <label for="name">用户名：</label>
		    <?php echo $this->tag->textField("name") ?>
		 </p>
		 <p>
		    <label for="email">E-Mail：</label>
		    <?php echo $this->tag->textField("email") ?>
		 </p>
		 <p>
		    <?php echo $this->tag->submitButton("Register") ?>
		 </p>
		</form>
	</div>
</div>