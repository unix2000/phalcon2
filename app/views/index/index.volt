<div class="page-header">
    <h1>Congratulations!</h1>
    {{ data }}
</div>

<p>You're now flying with Phalcon. Great things are about to happen!</p>

<p>This page is located at <code>views/index/index.volt</code></p>
<div class="form-group">
	<div class="input-group self_input_group">
		<input type="text" class="form-control" aria-describedby="basic-addon3" id="code" placeholder='请输入验证码' style="width:64%;">
		{#
		<img src="/tests/verify" id="verify" style="width:130px;height:32px;display:block-inline;padding:2px 0 0 5px;" />
		#}
		<a href="JavaScript:void(0);" onclick="javascript:document.getElementById('verify').src='/tests/verify&t=' + Math.random();" class="change" title="看不清，换一张">
            <img src="/tests/verify" name="verify" id="verify" border="0"/></a>

	</div>
</div>