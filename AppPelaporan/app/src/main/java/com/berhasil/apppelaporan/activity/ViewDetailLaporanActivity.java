package com.berhasil.apppelaporan.activity;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.berhasil.apppelaporan.R;
import com.berhasil.apppelaporan.utils.Constant;
import com.berhasil.apppelaporan.utils.SharePrefManager;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import butterknife.BindView;
import butterknife.ButterKnife;
import static com.berhasil.apppelaporan.api.RestClient.IMG_URL;

public class ViewDetailLaporanActivity extends AppCompatActivity {
    @BindView(R.id.imgPelaporanDetail)
    ImageView imgPelaporan;
    @BindView(R.id.namaPelaporanDetail)
    TextView kategoriPelaporan;
    @BindView(R.id.keteranganDetail)
    TextView keteranganDetail;
    @BindView(R.id.tanggalPelaporanDetail)
    TextView tanggalDetail;
    @BindView(R.id.statusPelaporan)
    TextView statusPelaporan;
    @BindView(R.id.noKtpDetial)
    TextView noKtpDetial;
    @BindView(R.id.namaUserDetial)
    TextView namaUserDetail;
    @BindView(R.id.noTelpDetial)
    TextView noTelpDetail;

    SharePrefManager sharePrefManager;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_detail_laporan);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        getSupportActionBar().setTitle("Detail Pelaporan");
        ButterKnife.bind(this);
        sharePrefManager = new SharePrefManager(this);

        Intent in = getIntent();
        kategoriPelaporan.setText(in.getStringExtra(Constant.NMKATEGORI_DETAIL));
        Glide.with(ViewDetailLaporanActivity.this)
                .load(IMG_URL + in.getStringExtra(Constant.IMG_DETAIL))
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .centerCrop()
                .into(imgPelaporan);
        keteranganDetail.setText(in.getStringExtra(Constant.KETERANGANLAP_DETAIL));
        tanggalDetail.setText(in.getStringExtra(Constant.TGL_PELAPORAN_DETAIL));
        statusPelaporan.setText(in.getStringExtra(Constant.STATUS_DETAIL));
        noKtpDetial.setText(sharePrefManager.getSpNoKtp());
        namaUserDetail.setText(sharePrefManager.getSpNamaUser());
        noTelpDetail.setText(in.getStringExtra(Constant.NOTELP_DETAIL));
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home :
                finish();
                break;
        }
        return super.onOptionsItemSelected(item);
    }
}
