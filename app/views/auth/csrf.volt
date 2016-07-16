{{ content() }}
<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>
<div class="form-box" id="login-box">
    <div class="header">测试csrf token</div>
    {{ form('class': 'form-inline','action':'auth/csrf') }}
        <div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" />
            </div>
            <div class="form-group">
            	<input type="password" name="pass" class="form-control" />
            </div>
        </div>
        <div class="footer">
        	<input type="submit" class="btn btn-primary" value="登陆" />
            <input type="hidden" name="<?php echo $this->security->getTokenKey() ?>"
                    value="<?php echo $this->security->getToken() ?>"/>

        </div>
    </form>
</div>