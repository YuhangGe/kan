package android.kankan.dodowaterfall.widget;

import android.content.res.AssetManager;

public class FlowTag {
	private int flowId;
	private String fileName;
	public final int finish = 2;
	public final int wait =1;
	private boolean download = false;

	public int getFlowId() {
		return flowId;
	}

	public void setFlowId(int flowId) {
		this.flowId = flowId;
	}

	public String getFileName() {
		return fileName;
	}

	public void setFileName(String fileName) {
		this.fileName = fileName;
	}

	private AssetManager assetManager;
	private int ItemWidth;

	public AssetManager getAssetManager() {
		return assetManager;
	}

	public void setAssetManager(AssetManager assetManager) {
		this.assetManager = assetManager;
	}

	public int getItemWidth() {
		return ItemWidth;
	}

	public void setItemWidth(int itemWidth) {
		ItemWidth = itemWidth;
	}
	public boolean getDownLoad()
	{
		return download;
	}
	public void setDownLoad(boolean download){
		this.download = download;
	}
}
