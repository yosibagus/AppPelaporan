package com.berhasil.apppelaporan.response;

import com.berhasil.apppelaporan.model.ModelKategori;
import com.google.gson.annotations.SerializedName;

import java.util.List;

public class ResponseKategori {

    @SerializedName("kategori")
    List<ModelKategori> AllKategori;

    public List<ModelKategori> getAllKategori() {
        return AllKategori;
    }

}
