<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile Form</div>

                    <div class="card-body">
                        <form id="profileForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                <img src="#" id="imagePreview" class="img-fluid preview d-none" alt="Preview Image">
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>

                            <div class="form-group">
                                <label>Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" checked>
                                    <label class="form-check-label" for="genderMale">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female">
                                    <label class="form-check-label" for="genderFemale">
                                        Female
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other">
                                    <label class="form-check-label" for="genderOther">
                                        Other
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hobby">Hobby</label>
                                <textarea class="form-control" id="hobby" name="hobby" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>