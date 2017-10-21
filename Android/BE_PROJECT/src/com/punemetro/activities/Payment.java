package com.punemetro.activities;

import org.json.JSONException;
import org.json.JSONObject;

import com.example.androidhive.R;
import com.punemetro.activities.library.UserFunctions;

import android.app.TabActivity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TabHost;
import android.widget.TabHost.TabSpec;


@SuppressWarnings("deprecation")
public class Payment extends TabActivity  {
	
	
	
	public String mno,cnt;
	public void onCreate(Bundle savedInstanceState)
	{
        super.onCreate(savedInstanceState);
        setContentView(R.layout.payment);
        Bundle extras = getIntent().getExtras();
		if (extras != null)
		{
		    mno = extras.getString("user");
		}
        
        TabHost tabHost = getTabHost();
        
        UserFunctions userFunction = new UserFunctions();
		JSONObject json = userFunction.getcount(mno);
		
		try {
			JSONObject json_user = json.getJSONObject("user");
			
			cnt = json_user.getString("ctt");
			
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
      
        TabSpec card = tabHost.newTabSpec("Card Payment");
        card.setIndicator("Card Payment", getResources().getDrawable(R.drawable.cred));
        Intent cardint = new Intent(this,Cardp.class);
        cardint.putExtra("user", mno);
        cardint.putExtra("count", cnt);
        card.setContent(cardint);
        
        TabSpec chng = tabHost.newTabSpec("Direct Payment");
        chng.setIndicator("Direct Payment", getResources().getDrawable(R.drawable.mny));
        Intent cpIntent = new Intent(this,Prepaid.class);
        cpIntent.putExtra("user", mno);
        cpIntent.putExtra("count", cnt);
        chng.setContent(cpIntent);
        
        tabHost.addTab(card);
        tabHost.addTab(chng);
        
       
	}

}
