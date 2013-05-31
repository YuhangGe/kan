package android.kankan.dodowaterfall.widget;

import java.io.BufferedInputStream;
import java.io.IOException;


import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.drawable.AnimationDrawable;
import android.kankan.dodowaterfall.PhotoActivity;
import android.kankan.dodowaterfall.WaterFall;
import android.widget.ImageView;
import android.widget.ScrollView;
import android.widget.Toast;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.AttributeSet;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup.LayoutParams;

public class FlowView extends ImageView implements View.OnClickListener,
		View.OnLongClickListener {

	private AnimationDrawable loadingAnimation;
	private FlowTag flowTag;
	private Context context;
	public Bitmap bitmap;
	private ImageLoaderTask task;
	private int columnIndex;// ?????????????????????
	private int rowIndex;// ?????????????????????
	private Handler viewHandler;
	private String waitImage = "images/wait.jpg";
	
	public FlowView(Context c, AttributeSet attrs, int defStyle) {
		super(c, attrs, defStyle);
		this.context = c;
		Init();
	}

	public FlowView(Context c, AttributeSet attrs) {
		super(c, attrs);
		this.context = c;
		Init();
	}

	public FlowView(Context c) {
		super(c);
		this.context = c;
		Init();
	}

	private void Init() {

		setOnClickListener(this);
		this.setOnLongClickListener(this);
		setAdjustViewBounds(true);

	}

	public boolean onLongClick(View v) {
		Log.d("FlowView", "LongClick");
		Toast.makeText(context, "?????????" + this.flowTag.getFlowId(),
				Toast.LENGTH_SHORT).show();
		return true;
	}

	public void onClick(View v) {
		Log.d("FlowView", "Click");
//		Toast.makeText(context, "?????????" + this.flowTag.getFlowId(),
//				Toast.LENGTH_SHORT).show();
		Intent it = new Intent(context,PhotoActivity.class);
		Bundle bundle = new Bundle();
		bundle.putString("fileName", flowTag.getFileName());
		it.putExtras(bundle);
		context.startActivity(it);
	}

	/**
	 * ????????????
	 */
	public void LoadImage() {
		if (getFlowTag() != null) {

			new LoadImageThread().start();
		}
	}

	/**
	 * ??????????????????
	 */
	public void Reload() {
		if (this.bitmap == null && getFlowTag() != null) {

			new ReloadImageThread().start();
		}
	}

	/**
	 * ????????????
	 */
	public void recycle() {
		setImageBitmap(null);
		if ((this.bitmap == null) || (this.bitmap.isRecycled()))
			return;
		this.bitmap.recycle();
		this.bitmap = null;
	}

	public FlowTag getFlowTag() {
		return flowTag;
	}

	public void setFlowTag(FlowTag flowTag) {
		this.flowTag = flowTag;
	}

	public int getColumnIndex() {
		return columnIndex;
	}

	public void setColumnIndex(int columnIndex) {
		this.columnIndex = columnIndex;
	}

	public int getRowIndex() {
		return rowIndex;
	}

	public void setRowIndex(int rowIndex) {
		this.rowIndex = rowIndex;
	}

	public Handler getViewHandler() {
		return viewHandler;
	}

	public FlowView setViewHandler(Handler viewHandler) {
		this.viewHandler = viewHandler;
		return this;
	}
	
//	public void setWaitImage(Bitmap)
//	{
//		BufferedInputStream buf;
//		try {
//			buf = new BufferedInputStream(flowTag.getAssetManager()
//					.open(flowTag.getFileName()));
//			bitmap = BitmapFactory.decodeStream(buf);
//		} catch (IOException e) {
//			// TODO Auto-generated catch block
//			e.printStackTrace();
//		}
//		
//	}
	
	class ReloadImageThread extends Thread {

		@Override
		public void run() {
			if (flowTag != null) {

				BufferedInputStream buf;
				try {
					buf = new BufferedInputStream(flowTag.getAssetManager()
							.open(flowTag.getFileName()));
					bitmap = BitmapFactory.decodeStream(buf);

				} catch (IOException e) {

					e.printStackTrace();
				}

				((Activity) context).runOnUiThread(new Runnable() {
					public void run() {
						if (bitmap != null) {// ?????????????????????????????????null
							setImageBitmap(bitmap);
						}
					}
				});
			}

		}
	}

	class LoadImageThread extends Thread {
		LoadImageThread() {
		}

		public void run() {
			//????????????????????????????????????
			//???????????????????????????1??????6???
			int randomTime = (int)(Math.random()*6);
			if (flowTag != null) {
				BufferedInputStream buf;
				try {
					buf = new BufferedInputStream(flowTag.getAssetManager()
							.open(waitImage));
					bitmap = BitmapFactory.decodeStream(buf);

				} catch (IOException e) {

					e.printStackTrace();
				}
				((Activity) context).runOnUiThread(new Runnable() {
					public void run() {
						if (bitmap != null) {// ?????????????????????????????????null
							int width = bitmap.getWidth();// ??????????????????
							int height = bitmap.getHeight();

							LayoutParams lp = getLayoutParams();

							int layoutHeight = (height * flowTag.getItemWidth()) / width;// ????????????
							if (lp == null) {
								lp = new LayoutParams(flowTag.getItemWidth(),
										layoutHeight);
							}
							setLayoutParams(lp);

							setImageBitmap(bitmap);
							Handler h = getViewHandler();
							Message m = h.obtainMessage(flowTag.wait, width,
									layoutHeight, FlowView.this);
							h.sendMessage(m);
						}
					}
				});
				try {
					Thread.sleep(randomTime*1000);
				} catch (InterruptedException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
				
				try {
					buf = new BufferedInputStream(flowTag.getAssetManager()
							.open(flowTag.getFileName()));
					bitmap = BitmapFactory.decodeStream(buf);

				} catch (IOException e) {

					e.printStackTrace();
				}
				
				// if (bitmap != null) {

				// ????????????????????????UI???????????????????????????
				// CalledFromWrongThreadException: Only the original thread that
				// created a view hierarchy can touch its views.
				// ???????????????Handler??????Looper??????Message??????????????????

				((Activity) context).runOnUiThread(new Runnable() {
					public void run() {
						if (bitmap != null) {// ?????????????????????????????????null
							int width = bitmap.getWidth();// ??????????????????
							int height = bitmap.getHeight();

							LayoutParams lp = getLayoutParams();

							int layoutHeight = (height * flowTag.getItemWidth())/width;// ????????????
							if (lp == null) {
								lp = new LayoutParams(flowTag.getItemWidth(),
										layoutHeight);
							}
							else
							{
								lp.height = layoutHeight;
								lp.width = flowTag.getItemWidth();
							}
							setLayoutParams(lp);

							setImageBitmap(bitmap);
							Handler h = getViewHandler();
							Message m = h.obtainMessage(flowTag.finish, width,
									layoutHeight, FlowView.this);
							h.sendMessage(m);
						}
					}
				});

				// }

			}

		}
	}
}
