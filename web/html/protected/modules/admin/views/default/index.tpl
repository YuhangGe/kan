<h4>活动管理</h4>

{$this->widget('bootstrap.widgets.TbTabs', [
'type'=>'tabs',
'placement'=>'left',
'tabs'=>[
['label'=>'查看活动', 'content'=>'<p>I\'m in Section 1.</p>', 'active'=>true],
['label'=>'Section 2', 'content'=>'<p>Howdy, I\'m in Section 2.</p>'],
['label'=>'搜索活动', 'content'=>'<p>What up girl, this is Section 3.</p>']
]
], true)}