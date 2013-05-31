package android.kankan.video;

import android.kankan.R;
import android.net.Uri;
import android.os.Bundle;
import android.app.Activity;
import android.content.pm.ActivityInfo;
import android.view.Menu;
import android.view.MenuItem;
import android.view.Window;
import android.view.WindowManager;
import android.widget.MediaController;
import android.widget.VideoView;
import android.support.v4.app.NavUtils;

public class VideoActivity extends Activity {

	private VideoView videoView;
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, 
        		WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE);
        setContentView(R.layout.video_main);
        videoView = (VideoView)findViewById(R.id.videoView);
        videoView.setVideoURI(Uri.parse("/mnt/sdcard/videos/test.mp4"));
        MediaController mediaController = new MediaController(this); 
        videoView.setMediaController(mediaController); 
        videoView.start(); 
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.video_main, menu);
        return true;
    }

    
}
