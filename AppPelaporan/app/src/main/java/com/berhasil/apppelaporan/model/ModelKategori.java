package com.berhasil.apppelaporan.model;

import com.google.gson.annotations.SerializedName;

public class ModelKategori {
    @SerializedName("kd_kat") private int kd_kat;
    @SerializedName("nm_kat") private String namaKategori;
    @SerializedName("img_kat") private String imgKat;
    @SerializedName("error") private String errorMessage;

    public int getKd_kat() {
        return kd_kat;
    }

    public String getNamaKategori() {
        return namaKategori;
    }

    public String getImgKat() {
        return imgKat;
    }

    public String getErrorMessage() {
        return errorMessage;
    }
}
