
<h4>登陆后台</h4>
{assign "form"  $this->beginWidget('bootstrap.widgets.TbActiveForm',
[
'id'=>'verticalForm',
'htmlOptions' => ['class'=>'well']
]
)}

{$form->textFieldRow($model, 'username', ['class'=>'span3'])}
{$form->passwordFieldRow($model, 'password', ['class'=>'span3'])}
<br/>
{$this->widget('bootstrap.widgets.TbButton', ['buttonType'=>'submit', 'label'=>'登陆'], true)}

{assign "form_end" $this->endWidget()}