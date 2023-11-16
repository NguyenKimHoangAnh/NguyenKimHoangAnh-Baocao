app.controller('contactController', function ($scope, $http) {
    $scope.submitContactForm = function () {
        if ($scope.contactForm.$valid) {
            // Tạo một đối tượng chứa dữ liệu liên hệ
            var contactData = {
                email: $scope.email,
                message: $scope.message
            };

            // Gửi yêu cầu POST đến một URL xử lý lời nhắn
            $http.post('/contact/send', contactData)
                .then(function (response) {
                    // Xử lý phản hồi thành công
                    console.log(response.data);
                    // Đặt thông báo thành công hoặc chuyển hướng
                })
                .catch(function (error) {
                    // Xử lý lỗi
                    console.log(error);
                    // Đặt thông báo lỗi hoặc xử lý lỗi khác
                });
        }
    };
});