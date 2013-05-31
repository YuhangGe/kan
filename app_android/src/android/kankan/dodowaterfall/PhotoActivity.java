package android.kankan.dodowaterfall;

import java.io.BufferedInputStream;
import java.io.IOException;

import android.kankan.R;
import android.os.Bundle;
import android.app.Activity;
import android.content.res.AssetManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ImageView;
import android.support.v4.app.NavUtils;

public class PhotoActivity extends Activity {
	
	private ImageView imageView;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_photo);
        imageView = (ImageView)findViewById(R.id.imageView);
        Bundle bundle = getIntent().getExtras();
        String fileName = bundle.getString("fileName");
        AssetManager asset_manager = this.getAssets();
        BufferedInputStream buf;
        Bitmap bitmap;
        try {
			buf = new BufferedInputStream(asset_manager.open(fileName));
			bitmap = BitmapFactory.decodeStream(buf);
			imageView.setImageBitmap(bitmap);
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.waterfall, menu);
        return true;
    }

    
}
