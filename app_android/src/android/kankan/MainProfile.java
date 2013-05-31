package android.kankan;

import android.app.Activity;
import android.content.Intent;
import android.kankan.dodowaterfall.WaterFall;
import android.kankan.video.ListVideoActivity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.ListView;

public class MainProfile extends Activity implements OnItemClickListener {
	
	/**
	 * 侧滑布局对象，用于通过手指滑动将左侧的菜单布局进行显示或隐藏。
	 */
	private SlidingLayout slidingLayout;

	/**
	 * menu按钮，点击按钮展示左侧布局，再点击一次隐藏左侧布局。
	 */
	private Button menuButton;
	
	private String[] menuItems = {"个人主页", "粉友", "相片", "视频",
			"搜索", "设置"};
	private ArrayAdapter<String> menuListAdapter;
	private static ListView menuListView;
	
	private LinearLayout main_profile_layout;


	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.main_profile);
		
		slidingLayout = (SlidingLayout) findViewById(R.id.testLayout);
		
		main_profile_layout = (LinearLayout) findViewById(R.id.main_profile_layout);
		slidingLayout.setScrollEvent(main_profile_layout);
		
		menuListView = (ListView) findViewById(R.id.menu_list);
		menuListAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, 
				menuItems);
		menuListView.setAdapter(menuListAdapter);

		menuListView.setOnItemClickListener(this);
		
		/*
		if (slidingLayout.isLeftLayoutVisible()) {
			slidingLayout.scrollToRightLayout();
		} else {
			slidingLayout.scrollToLeftLayout();
		}
		*/
		
		
		menuButton = (Button) findViewById(R.id.menuButton);
		
		
		menuButton.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// 实现点击一下menu展示左侧布局，再点击一下隐藏左侧布局的功能
				if (slidingLayout.isLeftLayoutVisible()) {
					slidingLayout.scrollToRightLayout();
				} else {
					slidingLayout.scrollToLeftLayout();
				}
			}
		});
	}


	@Override
	public void onItemClick(AdapterView<?> arg0, View arg1, int arg2, long arg3) {
		// TODO Auto-generated method stub
		if (arg2 == 0) {
			// 实现点击一下menu展示左侧布局，再点击一下隐藏左侧布局的功能
			
			slidingLayout.scrollToRightLayout();
			
			new Thread(new Runnable() {

				@Override
				public void run() {
					// TODO Auto-generated method stub
					
					try {
						Thread.sleep(350);
					} catch (InterruptedException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					
					
					Intent it = new Intent(MainProfile.this, MainProfile.class);
					startActivity(it); 
				}
				
			}).start();
			
			
			//SlidingMenu.this.finish();
		}
		
		else if (arg2 == 2) {			
			
			slidingLayout.scrollToRightLayout();
			
			new Thread(new Runnable() {

				@Override
				public void run() {
					// TODO Auto-generated method stub
					
					try {
						Thread.sleep(300);
					} catch (InterruptedException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					
					
					Intent it = new Intent(MainProfile.this, WaterFall.class);
					startActivity(it); 
				}
				
			}).start();
		}
		else if(arg2 == 3) {
			
			slidingLayout.scrollToRightLayout();
			new Thread(new Runnable() {

				@Override
				public void run() {
					// TODO Auto-generated method stub
					try {
						Thread.sleep(300);
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
					Intent it = new Intent(MainProfile.this, ListVideoActivity.class);
					startActivity(it);
				}
				
			}).start();
		}
	}
	
}
