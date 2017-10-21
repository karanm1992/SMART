package com.punemetro.activities;

import java.io.IOException;

import java.net.MalformedURLException;
import java.net.URL;
import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;


public class Qrcode extends Activity
{
	ImageView image_view;
	 Button btnLoadImg ;
	 public String mno,count,cnt,res = "";
	   
	 final static String imageLocation= "http://metropune.atwebpages.com/new/phpqrcode/retriv.php";
	protected void onCreate(Bundle savedInstanceState)
	{
		super.onCreate(savedInstanceState);
		setContentView(R.layout.qrcode);
		Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    mno = extras.getString("user");
		    count = extras.getString("no");
		}
		
		image_view = (ImageView)findViewById(R.id.imageView1);
        btnLoadImg = (Button)findViewById(R.id.btn_imgload);
         
        btnLoadImg.setOnClickListener(loadImage);
		
	}
	public void go_back(View clickedButton)
	{
		UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getcount(mno);
		
		try {
			JSONObject json_user = json.getJSONObject("user");
			
			cnt = json_user.getString("ctt");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		Intent activityIntent = new Intent(this,Sel_ticket.class);
		activityIntent.putExtra("user",mno);
		activityIntent.putExtra("no",cnt);
		startActivity(activityIntent);
	}
	View.OnClickListener loadImage = new View.OnClickListener(){
	     public void onClick(View view) {
	         loadImage(imageLocation);
	            }
	     };
	     
	     Bitmap bitmap;
	     void loadImage(String image_location){
	        
	           @SuppressWarnings("unused")
			URL imageURL = null;
	            
	           try {
	            imageURL = new URL(image_location);
	            } 
	            
	           catch (MalformedURLException e) {
	               e.printStackTrace();
	            }
	            
	           try {
	            //HttpURLConnection connection= (HttpURLConnection)imageURL.openConnection();
	            //connection.setDoInput(true);
	            //connection.connect();
	            //InputStream inputStream = connection.getInputStream();
	        	   DefaultHttpClient httpClient = new DefaultHttpClient();
	        	   HttpGet httpGet = new HttpGet("http://metropune.atwebpages.com/new/phpqrcode/retriv.php");
	               HttpResponse httpResponse = httpClient.execute(httpGet);
	               HttpEntity httpEntity = httpResponse.getEntity();
	               
	               res = EntityUtils.toString(httpEntity);
	               byte[] decodedString = Base64.decode(res.trim(),Base64.DEFAULT);
                   Bitmap decodedByte = BitmapFactory.decodeByteArray(
                           decodedString, 0, decodedString.length); 
	               //bitmap = BitmapFactory.decodeStream(inputStream);//Convert to bitmap
	               image_view.setImageBitmap(decodedByte);
	           }
	           catch (IOException e) {
	                
	                e.printStackTrace();
	           }
	     }
	
	
	
	
	
	 
}
	

