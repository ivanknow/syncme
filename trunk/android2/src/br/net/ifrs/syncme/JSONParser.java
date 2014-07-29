package br.net.ifrs.syncme;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.utils.URLEncodedUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.util.Log;
 
public class JSONParser {
 
    static InputStream is = null;
    static JSONObject jObj = null;
    static String json = "";
 
    // constructor
    public JSONParser() {
 
    }
 
    // function get json from url
    // by making HTTP POST or GET mehtod
    public JSONObject makeHttpRequest(String url, String method,
            List<NameValuePair> params) {
 
        // Making HTTP request
        try {
 
            // check for request method
            if(method == "POST"){
            	json = sendPost(url,params);
            	 Log.e("JSON",json);
            }else if(method == "GET"){
             
                json = sendGet(url,params);
                Log.e("JSON",json);
            }          
 
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        } catch (ClientProtocolException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
 
        // try parse the string to a JSON object
        try {
            jObj = new JSONObject(json);
        } catch (JSONException e) {
            Log.e("JSON Parser", "Rolas"+json);
        }
 
        // return JSON String
        return jObj;
 
    }
    
 // HTTP GET request
 	private String sendGet(String url,
            List<NameValuePair> params) throws Exception {

        String paramString = URLEncodedUtils.format(params, "utf-8");
        url += "?" + paramString;
        
 		URL obj = new URL(url);
 		HttpURLConnection con = (HttpURLConnection) obj.openConnection();
  
 		// optional default is GET
 		con.setRequestMethod("GET");
 		
 		int responseCode = con.getResponseCode();
  
 		BufferedReader in = new BufferedReader(
 		        new InputStreamReader(con.getInputStream(),"iso-8859-1"),8);
 		String inputLine;
 		StringBuffer response = new StringBuffer();
  
 		while ((inputLine = in.readLine()) != null) {
 			response.append(inputLine + "\n");
 		}
 		in.close();
  
 		//print result
 		return response.toString();
  
 	}
  
 	// HTTP POST request
 	private String sendPost(String url,
            List<NameValuePair> params) throws Exception {
  
 		URL obj = new URL(url);
 		HttpURLConnection con = (HttpURLConnection) obj.openConnection();
  
 		//add reuqest header
 		con.setRequestMethod("POST");
 		con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
  
 		String urlParameters =  URLEncodedUtils.format(params, "utf-8");
  
 		// Send post request
 		con.setDoOutput(true);
 		DataOutputStream wr = new DataOutputStream(con.getOutputStream());
 		wr.writeBytes(urlParameters);
 		wr.flush();
 		wr.close();
  
 		int responseCode = con.getResponseCode();

 		BufferedReader in = new BufferedReader(
 		        new InputStreamReader(con.getInputStream(),"iso-8859-1"),8);
 		String inputLine;
 		StringBuffer response = new StringBuffer();
  
 		while ((inputLine = in.readLine()) != null) {
 			response.append(inputLine + "\n");
 		}
 		in.close();
  
 		//print result
 		return response.toString();
  
 	}
}

