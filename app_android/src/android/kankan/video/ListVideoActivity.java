package android.kankan.video;

import java.util.ArrayList;
import java.util.HashMap;

import android.kankan.R;
import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ListView;
import android.widget.SimpleAdapter;

public class ListVideoActivity extends Activity implements OnItemClickListener{
	
	private ListView listView;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.video_list);
        listView = (ListView)findViewById(R.id.videoList);
        ArrayList<HashMap<String,Object>> listItemsArray = new ArrayList<HashMap<String,Object>>();
        for(int i=0;i<10;i++)
        {
        	HashMap<String,Object> mapItem = new HashMap<String,Object>();
        	mapItem.put("ListItemImage",R.drawable.test);
        	mapItem.put("ListItemText1","分享");
        	mapItem.put("ListItemText2","推荐");
        	listItemsArray.add(mapItem);
        }
        SimpleAdapter adapter = new SimpleAdapter(this,listItemsArray,R.layout.video_item,
        		new String[]{"ListItemImage","ListItemText1","ListItemText2"}, 
        		new int[]{R.id.ListItemImage,R.id.ListItemText1,R.id.ListItemText2});
        listView.setAdapter(adapter);
        listView.setOnItemClickListener(this);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.video_list, menu);
        return true;
    }

	public void onItemClick(AdapterView<?> arg0, View arg1, int arg2, long arg3) {
		// TODO Auto-generated method stub
		if(arg2 == 0) {
			Intent it = new Intent(this,VideoActivity.class);
			this.startActivity(it);
		}
	}

    
}
