package com.berhasil.apppelaporan.activity;

import android.content.Context;
import android.content.Intent;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Base64;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.api.BaseApiService;
import com.berhasil.apppelaporan.api.RestClient;
import com.berhasil.apppelaporan.utils.Constant;
import com.berhasil.apppelaporan.utils.SharePrefManager;

import java.io.ByteArrayOutputStream;
import java.io.FileNotFoundException;
import java.io.IOException;

import butterknife.BindView;
import butterknife.ButterKnife;
import okhttp3.ResponseBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class InputLaporanActivity extends AppCompatActivity {
    String tmpNamaKategori;
    String tmpIdKategori;

    @BindView(R.id.kategoriLaporan)
    TextView namaKategori;
    @BindView(R.id.choseBtn)
    Button choseBtn;
    @BindView(R.id.imgView)
    ImageView imgView;
    @BindView(R.id.et_lokasi_lap)
    EditText etLokasi;
    @BindView(R.id.et_ket_lap)
    EditText etketeranganLaporan;
    @BindView(R.id.et_ktp_lap)
    EditText etKtp;
    @BindView(R.id.et_nm_lap)
    EditText namaUser;
    @BindView(R.id.et_notelp_lap)
    EditText nomerTelp;

    private static final int IMG_REQUEST = 777;
    private Bitmap bitmap;
    BaseApiService mApiService;
    SharePrefManager sharePrefManager;
    Context context;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_input_laporan);
        getSupportActionBar().setTitle("Input Laporan");
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ButterKnife.bind(this);
        mApiService = RestClient.getApiService();
        sharePrefManager = new SharePrefManager(this);
        context = this;

        Intent in = getIntent();
        tmpIdKategori = in.getStringExtra(Constant.KEY_ID_KATEGORI);
        tmpNamaKategori = in.getStringExtra(Constant.KEY_NAMA_KATEGORI);

        //set data textview
        namaKategori.setText(tmpNamaKategori);
        etKtp.setText(sharePrefManager.getSpNoKtp());
        etKtp.setEnabled(false);
        namaUser.setText(sharePrefManager.getSpNamaUser());
        namaUser.setEnabled(false);
        nomerTelp.setText(sharePrefManager.getSpNotelpUser());
        nomerTelp.setEnabled(false);
        etLokasi.clearFocus();
        etketeranganLaporan.clearFocus();

        choseBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                selectImage();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.save_menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home :
                finish();
                break;
            case R.id.save :
                if (etKtp.getText().toString().isEmpty()) {
                    etKtp.setError("KTP tidak boleh kosong");
                } else if (etketeranganLaporan.getText().toString().isEmpty()) {
                    etketeranganLaporan.setError("Keterangan Tidak boleh kosong");
                } else if (etLokasi.getText().toString().isEmpty()) {
                    etLokasi.setError("Lokasi tidak boleh kosong");
                } else {
                    addPelaporanByIdKategori();
                }
                break;
        }
        return super.onOptionsItemSelected(item);
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
        byte [] imgByte =byteArrayOutputStream.toByteArray();
        return Base64.encodeToString(imgByte, Base64.DEFAULT);
    }

    private void addPelaporanByIdKategori() {
        String img = imgToString();
        String kd_kat = tmpIdKategori;
        String lokasi = etLokasi.getText().toString();
        String keterangan = etketeranganLaporan.getText().toString();
        String ktp = sharePrefManager.getSpNoKtp();

        Call<ResponseBody> rest = mApiService.addPelaporan(kd_kat, img, lokasi, keterangan, ktp);
        rest.enqueue(new Callback<ResponseBody>() {
            @Override
            public void onResponse(Call<ResponseBody> call, Response<ResponseBody> response) {
                if (response.isSuccessful()) {
                    Toast.makeText(InputLaporanActivity.this, "Berhasil Menyimpan Data", Toast.LENGTH_SHORT).show();
                    imgView.setVisibility(View.GONE);
                    startActivity(new Intent(context, ViewLaporanActivity.class)
                        .addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_NEW_TASK));
                }
                else {
                    Toast.makeText(InputLaporanActivity.this, "Gagal menyimpan data", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ResponseBody> call, Throwable t) {
                Toast.makeText(context, "Koneksi Bermasalah", Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        etketeranganLaporan.clearFocus();
        etLokasi.clearFocus();
    }
}
