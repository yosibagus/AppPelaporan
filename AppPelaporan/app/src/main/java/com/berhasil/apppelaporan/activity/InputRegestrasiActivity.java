package com.berhasil.apppelaporan.activity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Base64;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.api.BaseApiService;
import com.berhasil.apppelaporan.api.RestClient;
import com.berhasil.apppelaporan.utils.SharePrefManager;
import com.blogspot.atifsoftwares.animatoolib.Animatoo;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.IOException;

import butterknife.BindView;
import butterknife.ButterKnife;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class InputRegestrasiActivity extends AppCompatActivity {

    @BindView(R.id.choseBtnReg)
    Button choseBtn;
    @BindView(R.id.btnDaftar)
    Button btnDaftar;
    @BindView(R.id.imgViewDaftar)
    ImageView imgView;
    @BindView(R.id.etnoKtp)
    EditText etNoKtp;
    @BindView(R.id.etNama)
    EditText etNamaLengkap;
    @BindView(R.id.etNoTelp)
    EditText etNoTelp;
    @BindView(R.id.etPassword)
    EditText etPassword;

    private static final int IMG_REQUEST = 777;
    private Bitmap bitmap;
    BaseApiService mApiService;
    Context mContext;
    ProgressDialog loading;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_input_regestrasi);
        getSupportActionBar().hide();
        ButterKnife.bind(this);
        mApiService = RestClient.getApiService();
        mContext = this;

        choseBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectImage();
            }
        });

        btnDaftar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (etNoKtp.getText().toString().isEmpty() && etNamaLengkap.getText().toString().isEmpty() && etNoTelp.getText().toString().isEmpty() && etPassword.getText().toString().isEmpty()) {
                    Toast.makeText(mContext, "Form Tidak Boleh Kosong", Toast.LENGTH_SHORT).show();
                }
                else {
                    addRegestrasiUser();
                }
            }
        });
    }

    private void selectImage() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(intent, IMG_REQUEST);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode==IMG_REQUEST && resultCode==RESULT_OK && data!=null) {
            Uri path = data.getData();
            try {
                bitmap = MediaStore.Images.Media.getBitmap(getContentResolver(), path);
                imgView.setImageBitmap(bitmap);
                imgView.setVisibility(View.VISIBLE);
            } catch (FileNotFoundException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }
    }

    private String imgToString() {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 100, byteArrayOutputStream);
        byte [] imgByte = byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(imgByte, Base64.DEFAULT);
    }

    private void addRegestrasiUser() {
        loading = ProgressDialog.show(mContext, null, "Sedang Menyimpan Data", true, false);
        String ktp = etNoKtp.getText().toString();
        String img = imgToString();
        String nama = etNamaLengkap.getText().toString();
        String noTelp = etNoTelp.getText().toString();
        String password = etPassword.getText().toString();

        Call<ResponseBody> rest = mApiService.addRegestrasi(ktp, password, img, nama, noTelp);
        rest.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {
                    loading.dismiss();
                    Toast.makeText(mContext, "Berhasil Menyimpan Data", Toast.LENGTH_SHORT).show();
                    imgView.setVisibility(View.GONE);
                    startActivity(new Intent(mContext, LoginActivity.class)
                            .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                    finish();
                }
                else {
                    loading.dismiss();
                    Toast.makeText(mContext, "gagal menyimpan data", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {
                loading.dismiss();
                Toast.makeText(mContext, "Koneksi Bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Animatoo.animateSlideDown(mContext);
    }
}
